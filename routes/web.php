<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\CheckIfLoggedIn;
use App\Http\Middleware\EnsureUserIsTeacher;
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
})->name('azure.callback');