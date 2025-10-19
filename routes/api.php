<?php

use App\Http\Controllers\Api\AppSnapshotController;
use App\Http\Controllers\ScheduleController;
use App\Models\Tokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

        $tokenPlainText = $token->plainTextToken;

        Tokens::create([
            'plain_text_token' => $tokenPlainText,
            'email' => $user['email'],
            'expires_at' => now()->addMinutes(1)
        ]);

        return response()->json(["message" => 'User successfully registered', "token" => $tokenPlainText]);
        
    } catch (Exception $error) {
        return response()->json(["message" => $error->getMessage()], 500);
    }
});

Route::post('/email', function (Request $request) {
    try {

        $validated = $request->validate([
            'email' => $request['email']
        ]);

        $existingUser = User::where('email', $validated['email'])->first();

        if ($existingUser) {
            return response()->json([
                'message' => 'This email address is already in use. Please try logging in or use a different one.'
            ]);
        }
    } catch(Exception $error) {
        
    }
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/publish', [ScheduleController::class, 'store']);
    Route::get('/app-snapshot', [AppSnapshotController::class, 'index']);
    Route::post('/app-snapshot', [AppSnapshotController::class, 'store']);
});

Route::post('/token', function (Request $request) {

    try {

        $validated = $request->validate([
            'email' => 'email'
        ]);

        $email = $validated['email'];
        $token = Tokens::where('email', $email)->first();

        if(!$token) {
            return response()->json([
                'message' => 'No tokens were found associated with this email address.'
            ]);
        }

        return redirect()->away('fls-sti://callback?token='.$token);

    } catch (Exception $error) {
        return response()->json([
            'message' => $error->getMessage()
        ]);
    }
});
