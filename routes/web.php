<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProgramController::class, 'show'])->name('home');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('view.schedule');

Route::get('/timeslot/{id}', [ClassTimeSlotController::class, 'fetchTimeslots'])->name('get.schedule');