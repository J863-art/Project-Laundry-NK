<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.kasir'); // asumsi halaman login tetap di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
{
    // Ambil nilai username/email dan password dari request
    $credentials = $request->only('username', 'password');

    // Cek apakah input adalah email atau username
    if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)) {
        // Jika input adalah email, login dengan email
        $loginAttempt = Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']]);
    } else {
        // Jika input bukan email, anggap sebagai username
        $loginAttempt = Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']]);
    }

    // Jika login berhasil, cek apakah role-nya sesuai
    if ($loginAttempt) {
        // Cek apakah user adalah pemilik
        if (Auth::user()->role !== 'kasir') {
            Auth::logout();
            return redirect()->back()->withErrors(['username' => 'Akun ini bukan pemilik.']);
        }

        // Redirect ke dashboard pemilik
        return redirect()->route('login.ownerdashboard');
    }

    // Jika login gagal, kembali dengan error
    return redirect()->back()->withErrors(['username' => 'Email/Username atau password salah.']);
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


}
