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
use Illuminate\Http\Request;
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
    *   Move this to a controller
    */

    return Socialite::driver('azure')->redirect();
})->name('azure.redirect');

Route::get('/auth/callback', function () {

    /*
    *   Move this to a controller
    */

    $user = Socialite::driver('azure')->user();

    /*
    * Change the mail upon deployment vvv
    */

    if (str_contains($user['userPrincipalName'], 'retescharlesrenangmail.onmicrosoft.com') or str_contains($user['userPrincipalName'], 'calamba.sti.edu.ph')) {
        session(['isSameBranch' => true]);
    } else {
        return view('errors.403-2');
    }

    if (session('source') === 'desktop') {

        session()->forget('source');
        $userId = $user['id'];
        $email = $user['userPrincipalName'];
        $firstName = $user['givenName'];
        $lastName = $user['surname'];

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            return view('pages.desktop.duplicate-account');
        }

        $user = User::updateOrCreate([
            'email' => $email
        ], [
            'id' => $userId,
            'name' => $firstName . ' ' . $lastName,
            'email' => $email,
            'password' => 'remove_password'
        ]);

        $token = $user->createToken(str_replace(' ', '_', strtolower($user->name)) . "_token");

        $tokenPlainText = $token->plainTextToken;

        if (!$email) {
            abort(500, 'Email was not returned from Microsoft login.');
        }

        Tokens::create([
            'plain_text_token' => $tokenPlainText,
            'email' => $email,
            'expires_at' => now()->addMinutes(1)
        ]);

        return redirect()->route('register.success', [
            'userId' => $userId,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'apiToken' => $tokenPlainText
        ]);
    } else {

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
    }
})->name('azure.callback');

Route::get('/register', function () {

    /*  http://localhost:8000/register?source=<desktop></desktop>
    *   
    *   Create a middleware to protect this route
    */
    if (request()->get('source') !== 'desktop') {
        return view('errors.403-2');
    }

    session(['source' => request()->get('source')]);

    return view('pages.desktop.desktop-app-login', ["pagetitle" => 'Register']);
});

Route::get('/register/success', function (Request $request) {

    $data = [
        'userId' => $request['userId'],
        'firstName' => $request['firstName'],
        'lastName' => $request['lastName'],
        'email' => $request['email'],
        'apiToken' => $request['apiToken']
    ];

    return view('pages.desktop.success-page', $data);
})->name('register.success');
