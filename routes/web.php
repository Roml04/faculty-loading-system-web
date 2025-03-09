<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.program-selection');
})->name('home');

Route::get('/search', [SearchController::class, 'search'])->name('search');