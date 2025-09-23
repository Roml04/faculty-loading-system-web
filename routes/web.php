<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\CheckIfLoggedIn;
use App\Http\Middleware\EnsureUserIsTeacher;
use App\Models\Tokens;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('pages.sign-in', ['pagetitle' => 'Sign In']);
})->name('login');

Route::middleware([CheckIfLoggedIn::class])->group(function () {
    Route::get('/board', [ProgramController::class, 'show'])->name('home');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

    Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('section.schedule');

    Route::get('/sections/timeslots/{id}', [ClassTimeSlotController::class, 'sectionTimeSlots'])->name('get.schedule');

    Route::get('/teachers/timeslots/{id}', [ClassTimeSlotController::class, 'teacherTimeSlots']);

    Route::get('/teachers/schedule/{id}', [TeacherController::class, 'show'])->middleware(EnsureUserIsTeacher::class)->name('teacher.schedule');
});

Route::get('/auth/redirect', function () {

    /*
    *   NOTES: Move this to a controller
    */

    return Socialite::driver('azure')->redirect();
})->name('azure.redirect');

Route::get('/auth/callback', function () {

    /*
    *   NOTES: Move this to a controller
    */

    $user = Socialite::driver('azure')->user();

    /*
    * NOTES: Change the mail upon deployment vvv
    */

    if (str_contains($user['userPrincipalName'], 'retescharlesrenangmail.onmicrosoft.com') or str_contains($user['userPrincipalName'], 'calamba.sti.edu.ph')) {
        session(['isSameBranch' => true]);
    } else {
        abort(403);
    }

    /*
    * Checks if the HTTP request came from the desktop and is an account SIGN IN
    */
    if ((session('source') === 'desktop') and (session('action') === 'signin')) {
        
        try {

            session()->forget('source');
            $signinEmail = $user['mail'];

            $user = User::where('email', $signinEmail)->first();

            /*
            * Checks if the email does not exist in the web's database
            */ 
            if ($user === null) {
                return view('pages.desktop.not-registered');
            }

            $token = Tokens::where('email', $signinEmail)->first();

            if($token === null) {
                return response()->json([
                    'message' => 'No tokens were found associated with this email address.',
                ], 404);
            }

            return view('pages.desktop.success-page', [
                'action' => "Sign in",
                'apiToken' => $token['plain_text_token']
            ]);

        } catch(Exception $error) {
            return response()->json([
                'message' => $error->getMessage()
            ]);
        }

    }

    /*
    * Checks if the HTTP request came from the desktop and is an account REGISTRATION
    */
    if ((session('source') === 'desktop') and (session('action') === 'register')) {

        try {
            session()->forget('source');
            $userId = $user['id'];
            $email = $user['userPrincipalName'];
            $firstName = $user['givenName'];
            $lastName = $user['surname'];

            $existingUser = User::where('email', $email)->first();

            /*
            * Checks if the user's email exists in the web's database
            */
            if ($existingUser) {

                $token = Tokens::where('email', $existingUser['email'])->first();

                if($token === null) {
                    return response()->json([
                        'message' => 'No tokens were found associated with this email address.',
                    ], 404);
                }

                return view('pages.desktop.success-page', [
                    'action' => "Sign in",
                    'apiToken' => $token['plain_text_token']
                ]);

            }

            $user = User::updateOrCreate([
                'email' => $email
            ], [
                'id' => $userId, // NOTES: Create a new column for microsoft ID
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => 'remove_password' // NOTES: Don't store passwords. Remove the password column on the table and model
            ]);

            $token = $user->createToken(str_replace(' ', '_', strtolower($user->name)) . "_token");

            $tokenPlainText = $token->plainTextToken;

            if (!$email) {
                abort(500, 'Email was not returned from Microsoft login.');
            }

            /* 
            * NOTES: This feels useless since there is no middleware removing expired tokens.
            * I'm also not sure if removing tokens, in general, would break anything.
            */
            
            Tokens::create([
                'plain_text_token' => $tokenPlainText,
                'email' => $email,
                'expires_at' => now()->addMinutes(1)  
            ]);

            return view('pages.desktop.success-page', [
                'action' => "Registration",
                'apiToken' => $tokenPlainText
            ]);

        } catch(Exception $error) {
            return response()->json([
                'message' => $error->getMessage()
            ]);
        }

    }

    $displayName = $user['displayName'];

    if (str_contains($displayName, '(Student)')) {
        $role = 'Student';
    } elseif (str_contains($displayName, '(Faculty)')) {
        $role = 'Teacher';
    } else {
        $role = 'Unknown';
    }

    session(['role' => $role]);
    session()->save();

    return redirect('/board');

})->name('azure.callback');

Route::get('/signin', function () {

    /*  http://localhost:8000/register?source=desktop&action=signin
    *   
    *   Create a middleware to protect this route
    */
    if (request()->get('source') !== 'desktop') {
        abort(403);
    }

    session(['source' => request()->get('source'), 'action' => 'signin']);

    return view('pages.desktop.desktop-app-login', ["pagetitle" => 'Register']);
})->name('register');

Route::get('/register', function () {

    /*  http://localhost:8000/register?source=desktop&action=register
    *   
    *   Create a middleware to protect this route
    */
    if (request()->get('source') !== 'desktop') {
        abort(403);
    }

    session(['source' => request()->get('source'), 'action' => 'register']);

    return view('pages.desktop.desktop-app-login', ["pagetitle" => 'Register']);
});