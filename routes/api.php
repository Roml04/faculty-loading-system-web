<?php

use App\Http\Controllers\Api\AppSnapshotContoller;
use App\Http\Controllers\ScheduleController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/user', function (Request $request) {

    try {

        $validated = $request->validate([
            "name" => "string",
            "email" => "email",
            "password" => "string"
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $token = $user->createToken(str_replace(' ', '_', strtolower($user->name)) . "_token");

        return response()->json(["message" => $token->plainTextToken]);
    } 

    catch(Exception $error) {
        return ["message" => $error->getMessage()];
    }

});

Route::post('/publish', [ScheduleController::class, 'store'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/app-snapshot', [AppSnapshotContoller::class, 'index']);
});