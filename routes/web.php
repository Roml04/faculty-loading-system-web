<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('pages.sign-in', ['pagetitle' => 'Sign In']);
})->name('login');

Route::get('/board', [ProgramController::class, 'show'])->name('home');

Route::get('/teachers/schedule/{id}', [TeacherController::class, 'show'])->name('teacher.schedule');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('section.schedule');

Route::get('/sections/timeslots/{id}', [ClassTimeSlotController::class, 'sectionTimeSlots'])->name('get.schedule');

Route::get('/teachers/timeslots/{id}', [ClassTimeSlotController::class, 'teacherTimeSlots']);

Route::get('/auth/redirect', function () {
    return Socialite::driver('azure')->redirect();
})->name('azure.redirect');

Route::get('/auth/callback', function () {
    $user = Socialite::driver('azure')->user();

    session(['role' => 'student']);

    return redirect('/board');
})->name('azure.callback');