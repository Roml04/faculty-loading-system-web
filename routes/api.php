<?php

use App\Http\Controllers\Api\AppSnapshotController;
use App\Http\Controllers\ScheduleController;
use App\Models\Tokens;
use App\Models\User;
use Illuminate\Http\Request;
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
    } catch (Exception $error) {
        return ["message" => $error->getMessage()];
    }
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/publish', [ScheduleController::class, 'store']);
    Route::get('/app-snapshot', [AppSnapshotController::class, 'index']);
    Route::post('/app-snapshot', [AppSnapshotController::class, 'store']);
});

Route::post('/token', function (Request $request) {

    /*
    *   NOTES: Create(?) a middleware that deletes expired tokens
    */
    $validated = $request->validate([
        'email' => 'email'
    ]);

    $email = $validated['email'];

    $user = User::where('email', $email)->first();

    if ($user) {
        $token = Tokens::where('email', $email)->first();

        return response()->json([
            'token' => $token
        ]);
    } else {
        return response()->json([
            'message' => 'No tokens were found associated with that email.'
        ]);
    }
});
