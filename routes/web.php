<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.program-selection');
});

Route::get('/search', [SearchController::class, 'search']);