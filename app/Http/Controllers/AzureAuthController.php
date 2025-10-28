<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\ClassTimeSlot;
use Illuminate\Support\Str;
use App\Models\Tokens;
use App\Models\User;
use Exception;

class AzureAuthController extends Controller
{
    public function authRedirect() {

        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */

        $driver = Socialite::driver('azure');
        return $driver->with(['prompt' => 'select_account'])->redirect();

    }

    public function authCallback() {

        $user = Socialite::driver('azure')->user();

            $whitelistedDomains = config('domains.whitelisted_domains');
            $userDomain = Str::after($user['userPrincipalName'], '@');

            if (in_array($userDomain, $whitelistedDomains)) {
                session(['isSameBranch' => true]);
            } else {
                abort(403);
            }

            /*
            * Checks if the HTTP request came from the desktop and is an account SIGN IN
            */
            if ((session('source') === 'desktop') and (session('action') === 'signin')) {
                
                try {

                    session()->forget('source');
                    $signinEmail = $user['mail'];

                    $user = User::where('email', $signinEmail)->first();

                    /*
                    * Checks if the email does not exist in the web's database
                    */ 
                    if ($user === null) {
                        return view('pages.desktop.not-registered');
                    }

                    $token = Tokens::where('email', $signinEmail)->first();

                    if($token === null) {
                        return response()->json([
                            'message' => 'No tokens were found associated with this email address.',
                        ], 404);
                    }

                    return view('pages.desktop.success-page', [
                        'action' => "Sign in",
                        'apiToken' => $token['plain_text_token']
                    ]);

                } catch(Exception $error) {
                    return response()->json([
                        'message' => $error->getMessage()
                    ]);
                }

            }

            /*
            * Checks if the HTTP request came from the desktop and is an account REGISTRATION
            */
            if ((session('source') === 'desktop') and (session('action') === 'register')) {

                try {
                    session()->forget('source');
                    $userId = $user['id'];
                    $email = $user['userPrincipalName'];
                    $firstName = $user['givenName'];
                    $lastName = $user['surname'];

                    $existingUser = User::where('email', $email)->first();

                    /*
                    * Checks if the user's email exists in the web's database
                    */
                    if ($existingUser) {

                        $token = Tokens::where('email', $existingUser['email'])->first();

                        if($token === null) {
                            return response()->json([
                                'message' => 'No tokens were found associated with this email address.',
                            ], 404);
                        }

                        return view('pages.desktop.success-page', [
                            'action' => "Sign in",
                            'apiToken' => $token['plain_text_token']
                        ]);

                    }

                    $user = User::updateOrCreate([
                        'email' => $email
                    ], [
                        'id' => $userId, 
                        'name' => $firstName . ' ' . $lastName,
                        'email' => $email,
                        'password' => 'remove_password' 
                    ]);

                    $token = $user->createToken(str_replace(' ', '_', strtolower($user->name)) . "_token");

                    $tokenPlainText = $token->plainTextToken;

                    if (!$email) {
                        abort(500);
                    }
                    
                    Tokens::create([
                        'plain_text_token' => $tokenPlainText,
                        'email' => $email,
                        'expires_at' => now()->addMinutes(1)  
                    ]);

                    return view('pages.desktop.success-page', [
                        'action' => "Registration",
                        'apiToken' => $tokenPlainText
                    ]);

                } catch(Exception $error) {
                    return response()->json([
                        'message' => $error->getMessage()
                    ]);
                }

            }

            $displayName = $user['displayName'];

            if (str_contains($displayName, '(Student)')) {
                $role = 'Student';
            } elseif (str_contains($displayName, '(Faculty)') or in_array($userDomain, config('domains.admin_domains'))) {
                $role = 'Teacher';
            } else {
                $role = 'Unknown';
            }

            session(['role' => $role]);
            session()->save();

            return redirect('/board');

    }
}
