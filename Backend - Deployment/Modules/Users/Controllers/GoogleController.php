<?php

namespace Modules\Users\Controllers;

use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;
use Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find user by email
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Create a new user (default role can be Student = 1)
                $user = User::create([
                    'firstName' => $googleUser->user['given_name'] ?? 'Google',
                    'lastName' => $googleUser->user['family_name'] ?? 'User',
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)), // random password
                    'roleID' => 1, // default student role
                    'status_id' => 2, // registered status
                    'isActive' => true,
                ]);
            }

            // Generate token (using the same logic as your Login method)
            $tokenResult = $user->createToken('auth_token', ['*'], now()->addHours(3));
            $plainTextToken = $tokenResult->plainTextToken;

            // Redirect back to frontend
            $frontendUrl = env('FRONTEND_URL', 'http://localhost');
            return redirect($frontendUrl . '/google-callback?token=' . $plainTextToken . '&user=' . urlencode(json_encode($user)));

        } catch (\Exception $e) {
            $frontendUrl = env('FRONTEND_URL', 'http://localhost');
            return redirect($frontendUrl . '/login?error=' . urlencode('Google login failed: ' . $e->getMessage()));
        }
    }
}