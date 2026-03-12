<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

            // Log in the user
            Auth::login($user);

            return redirect('/dashboard'); // or wherever your frontend is

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Google login failed: ' . $e->getMessage()]);
        }
    }
}