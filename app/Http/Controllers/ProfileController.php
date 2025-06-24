<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        // Mengambil data pengguna yang sedang login
        $user = auth()->user();

        return view('dashboard', compact('user'));
    }
}
