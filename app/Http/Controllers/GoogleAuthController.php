<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Ambil bagian sebelum @ dari email untuk username default
        $username = explode('@', $googleUser->getEmail())[0];

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),], [
            'name' => $googleUser->getName(),
            'username' => $username, // tambahkan username agar tidak error
            'google_id' => $googleUser->getId(),
            'password' => bcrypt('defaultpassword'), // bisa diganti jika mau lebih aman
        ]);

        Auth::login($user);

        return redirect('/home'); // arahkan ke dashboard sesuai role
    }
}
