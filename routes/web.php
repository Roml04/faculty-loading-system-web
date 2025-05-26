<?php

use App\Http\Controllers\ClassTimeSlotController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProgramController::class, 'show'])->name('home');

Route::get('/teachers/schedule/{id}', [TeacherController::class, 'show'])->name('teacher.schedule');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/sections/{id}', [SectionController::class, 'indexSections'])->name('sections');

Route::get('/sections/schedule/{id}', [SectionController::class, 'viewSection'])->name('section.schedule');

Route::get('/sections/timeslots/{id}', [ClassTimeSlotController::class, 'sectionTimeSlots'])->name('get.schedule');

Route::get('/teachers/timeslots/{id}', [ClassTimeSlotController::class, 'teacherTimeSlots']);