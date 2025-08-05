<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\CheckIfLoggedIn;
use App\Http\Middleware\EnsureUserIsTeacher;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('pages.sign-in', ['pagetitle' => 'Sign In']);
})->name('login');

Route::middleware([CheckIfLoggedIn::class])->group(function() {
    Route::get('/board', [ProgramController::class, 'show'])->name('home');

    Route::get('/teachers/schedule/{id}', [TeacherController::class, 'show'])->middleware(EnsureUserIsTeacher::class)->name('teacher.schedule');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

    Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('section.schedule');

    Route::get('/sections/timeslots/{id}', [ClassTimeSlotController::class, 'sectionTimeSlots'])->name('get.schedule');

    Route::get('/teachers/timeslots/{id}', [ClassTimeSlotController::class, 'teacherTimeSlots']);
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('azure')->redirect();
})->name('azure.redirect');

Route::get('/auth/callback', function () {

    $user = Socialite::driver('azure')->user();
    
    if(str_contains($user['mail'], 'calamba.sti.edu.ph')) {
        session(['isSameBranch' => true]);
    } else {
        return view('errors.403-2');
    }

    if(session('source') === 'desktop') {
        
        $userId = $user['id'];
        $email = $user['mail'];
        $firstName = $user['givenName'];
        $lastName = $user['surname'];

        $existingUser = User::where('email', $email)->first();

        if(!$existingUser->wasRecentlyCreated) {
            return view('pages.desktop.duplicate-account');
        }

        $user = User::updateOrCreate([
            'email' => $email
        ],[
            'id' => $userId,
            'name' => $firstName . ' ' . $lastName,
            'email' => $email,
            'password' => 'remove_password'
        ]);

        $token = $user->createToken(str_replace(' ', '_', strtolower($user->name)) . "_token");

        dump(session());

        return response()->json([
            'id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'api_token' => $token->plainTextToken
        ]);
        
    } else {

        $displayName = $user['displayName'];

        if(str_contains($displayName, '(Student)')) {
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

    /*  http://localhost:8000/register?source=desktop
    *   
    *   Create a middleware to protect this route
    */
    session(['source' => request()->get('source')]);

    return view('pages.desktop-app-login', ["pagetitle" => 'Register']);
});