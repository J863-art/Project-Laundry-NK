<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;



class AuthOwnerController extends Controller
{
    public function showLoginForm()
    {
        return view('login.owner'); // asumsi halaman login tetap di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Coba login dengan email
        if (Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            // Lanjutkan jika role = pemilik
            if (Auth::user()->role !== 'pemilik') {
                Auth::logout();
                return redirect()->back()->withErrors(['username' => 'Akun ini bukan pemilik.']);
            }
            return redirect()->route('login.ownerdashboard');
        }

        // Coba login dengan name/username
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            if (Auth::user()->role !== 'pemilik') {
                Auth::logout();
                return redirect()->back()->withErrors(['username' => 'Akun ini bukan pemilik.']);
            }
            return redirect()->route('owner.dashboard');
        }

        // Jika dua-duanya gagal
        return redirect()->back()->withErrors(['username' => 'Login gagal. Cek kembali username dan password.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();  // Menghapus sesi autentikasi (logout)

        // Menghentikan semua sesi yang sedang berjalan
        $request->session()->invalidate();

        // Menghasilkan token sesi baru untuk mencegah penggunaan session hijacking
        $request->session()->regenerateToken();

        // Mengarahkan pengguna ke halaman yang dituju setelah logout
        return redirect('/welcome');
    }

    public function showForgotPasswordForm()
    {
        return view('login.owner-forgot-password');
    }



public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email|exists:users,email']);

    // Ensure only 'pemilik' role users can reset the password
    $user = \App\Models\User::where('email', $request->email)->where('role', 'pemilik')->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak terdaftar sebagai pemilik.']);
    }

    // Send the reset link email using Laravel's built-in functionality
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
}



public function showResetForm($token)
{
    return view('login.owner-reset-password', ['token' => $token]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = \App\Models\User::where('email', $request->email)->where('role', 'pemilik')->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak terdaftar sebagai pemilik.']);
    }

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    return $status == Password::PASSWORD_RESET
        ? redirect()->route('login.owner')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }


}


