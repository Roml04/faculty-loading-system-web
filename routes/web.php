<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProgramController::class, 'show'])->name('home');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/sections/{id}', [SectionController::class, 'show'])->name('sections');

Route::get('schedules/{id}', function() {
    return view('pages.view-schedule', ['sectionname' => 'Unknown']);
})->name('view.schedule');

Route::get('/schedule/getclasstimeslots', [ClassTimeSlotController::class, 'get_classtimeslots'])->name('get.schedule');