<?php

use App\Http\Controllers\AzureAuthController;
use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\CheckIfLoggedIn;
use App\Http\Middleware\EnsureUserIsTeacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('pages.sign-in', ['pagetitle' => 'Sign In']); })->name('login');

Route::middleware([CheckIfLoggedIn::class])->group(function () {
    Route::get('/board', [ProgramController::class, 'show'])->name('home');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

    Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('section.schedule');

    Route::get('/sections/timeslots/{id}', [ClassTimeSlotController::class, 'sectionTimeSlots'])->name('get.schedule');

    Route::get('/teachers/timeslots/{id}', [ClassTimeSlotController::class, 'teacherTimeSlots']);

    Route::get('/teachers/schedule/{id}', [TeacherController::class, 'show'])->middleware(EnsureUserIsTeacher::class)->name('teacher.schedule');
});

Route::get('/auth/redirect', [AzureAuthController::class, 'authRedirect'])->name('azure.redirect');
Route::get('/auth/callback', [AzureAuthController::class, 'authCallback'])->name('azure.callback');

/*
* 
*/

Route::get('/signin', function () {

    if (request()->get('source') !== 'desktop') {
        abort(403);
    }

    session(['source' => request()->get('source'), 'action' => 'signin']);

    return view('pages.desktop.desktop-app-login', ["pagetitle" => 'Register']);
})->name('register');

Route::get('/register', function () {

        if (request()->get('source') !== 'desktop') {
        abort(403);
    }

    session(['source' => request()->get('source'), 'action' => 'register']);

    return view('pages.desktop.desktop-app-login', ["pagetitle" => 'Register']);
});