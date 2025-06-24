<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthKasirController extends Controller
{
    public function showLoginForm()
    {
        return view('login.kasir');
    }

     public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Coba login dengan email
        if (Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            // Lanjutkan jika role = pemilik
            if (Auth::user()->role !== 'kasir') {
                Auth::logout();
                return redirect()->back()->withErrors(['username' => 'Akun ini bukan pemilik.']);
            }
            return redirect()->route('login.kasirdashboard');
        }

        // Coba login dengan name/username
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            if (Auth::user()->role !== 'kasir') {
                Auth::logout();
                return redirect()->back()->withErrors(['username' => 'Akun ini bukan pemilik.']);
            }
            return redirect()->route('kasir.dashboard');
        }

        // Jika dua-duanya gagal
        return redirect()->back()->withErrors(['username' => 'Login gagal. Cek kembali username dan password.']);
    }

    public function showForgotPasswordForm()
    {
        return view('login.kasir-forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/welcome');
    }
}

