<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan email atau google_id
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Login user yang sudah ada
                Auth::login($existingUser, true);
            } else {
                // Buat user baru
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider_name' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                    'role' => 'donatur',
                ]);

                Auth::login($newUser, true);
            }

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Google login gagal: ' . $e->getMessage()]);
        }
    }
}
