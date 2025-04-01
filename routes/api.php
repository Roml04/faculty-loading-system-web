<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {

    $user = User::create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => 'admin1234'
    ]);

    $token = $user->createToken(str_replace(' ', '_', $user->name) . "_token");

    return "Successfully created admin: " . $token->plainTextToken;
});

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/auth/register', function(Request $request) {

        return "Success!";

    });
    
});