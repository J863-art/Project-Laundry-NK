<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthOwnerController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\AuthKasirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\WelcomeControllerController;

Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/', function () {
    return view('welcome');
});

// Rute Login Kasir
Route::get('/login/kasir', function () {
    return view('login.kasir');
})->name('login.kasir');

// Rute Login Owner
Route::get('/login/owner', function () {
    return view('login.owner');
})->name('login.owner');

// Rute Login dengan Google
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Rute Home (Dashboard setelah login)
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

// Rute Login dan Logout untuk Owner
Route::get('/login/owner', [AuthOwnerController::class, 'showLoginForm'])->name('login.owner');
Route::post('/login/owner', [AuthOwnerController::class, 'login'])->name('login.owner.login');




// Login Kasir
Route::get('/login/kasir', [AuthKasirController::class, 'showLoginForm'])->name('login.kasir');
Route::post('/login/kasir', [AuthKasirController::class, 'login'])->name('login.kasir.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('login.kasir.kasirdashboard');
    })->name('login.kasirdashboard');
});


Route::get('/logout', function () {
    Auth::logout();
    return view('welcome'); // mengarah ke welcome.blade.php
})->name('logout');


// Rute Login dan Logout untuk Kasir (Manual)
//Route::get('/login/kasir', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login/kasir', [AuthController::class, 'login'])->name('login.post');
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Dashboard Kasir (Setelah Login)
//Route::middleware(['auth'])->group(function () {
 //   Route::get('/kasir/dashboard', function () {
   //     return view('login.kasirdashboard');
   // })->name('login.kasirdashboard');
//});

// Rute untuk Dashboard Owner (Setelah Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/owner/dashboard', function () {
        return view('login.ownerdashboard');
    })->name('login.ownerdashboard');
});

//Rute untuk forget password dan reset password owner atau pemiliki
Route::get('/owner/forgot-password', [AuthOwnerController::class, 'showForgotPasswordForm'])->name('owner.forgot.password');
Route::post('/owner/forgot-password', [AuthOwnerController::class, 'sendResetLinkEmail'])->name('owner.forgot.password.send');

Route::get('/owner/reset-password/{token}', [AuthOwnerController::class, 'showResetForm'])->name('owner.password.reset');
Route::post('/owner/reset-password', [AuthOwnerController::class, 'resetPassword'])->name('owner.password.update');


//Rute untuk forget password kasir
Route::get('/kasir/forgot-password', [AuthKasirController::class, 'showForgotPasswordForm'])->name('kasir.forgot.password');


// Rute Default Auth (menangani login, logout otomatis)
Auth::routes();

// Rute Default Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rute logout owner
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'showProfile'])->name('dashboard');
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    })->name('logout');
});


// Rute untuk semua pesanan
Route::get('/owner/pesanan', function () {
    return view('login.owner.semua-pesanan');
})->name('owner.pesanan');
Route::get('/owner/pesanan', [PesananController::class, 'index'])->name('owner.pesanan');

// Rute untuk pesanan yang sedang diproses
Route::get('/owner/pesanan/proses', function () {
    return view('login.owner.pesanan-proses');
})->name('owner.pesanan-diproses');
Route::get('/owner/pesanan/proses', [PesananController::class, 'sedangDiproses'])->name('owner.pesanan-diproses');

// Rute untuk pesanan yang belum diproses
Route::get('/owner/pesanan/belumdiproses', function () {
    return view('login.owner.pesanan-belumdiproses');
})->name('owner.pesanan-belum');
Route::get('/owner/pesanan/belum-diproses', [PesananController::class, 'belumDiproses'])->name('owner.pesanan-belum');

// Rute untuk pesanan yang selesai
Route::get('/owner/pesanan/selesai', function () {
    return view('login.owner.pesanan-selesai');
})->name('owner.pesanan-selesai');
Route::get('/owner/pesanan/selesai', [PesananController::class, 'selesai'])->name('owner.pesanan-selesai');


// Rute untuk semua pesanan
Route::get('/owner/pesanan', function () {
    return view('login.owner.semua-pesanan');
})->name('owner.pesanan');
Route::get('/owner/pesanan', [PesananController::class, 'index'])->name('owner.pesanan');

// Rute untuk pesanan yang sedang diproses
Route::get('/owner/pesanan/proses', function () {
    return view('login.owner.pesanan-proses');
})->name('owner.pesanan-diproses');
Route::get('/owner/pesanan/proses', [PesananController::class, 'sedangDiproses'])->name('owner.pesanan-diproses');

// Rute untuk pesanan yang belum diproses
Route::get('/owner/pesanan/belumdiproses', function () {
    return view('login.owner.pesanan-belumdiproses');
})->name('owner.pesanan-belum');
Route::get('/owner/pesanan/belum-diproses', [PesananController::class, 'belumDiproses'])->name('owner.pesanan-belum');

// Rute untuk pesanan yang selesai
Route::get('/owner/pesanan/selesai', function () {
    return view('login.owner.pesanan-selesai');
})->name('owner.pesanan-selesai');
Route::get('/owner/pesanan/selesai', [PesananController::class, 'selesai'])->name('owner.pesanan-selesai');





// Rute untuk semua pesanan
Route::get('/kasir/pesanan', function () {
    return view('login.kasir.semua-pesanan');
})->name('kasir.pesanan');
Route::get('/kasir/pesanan', [PesananController::class, 'indexkasir'])->name('kasir.pesanan');

// Rute untuk pesanan yang sedang diproses
Route::get('/kasir/pesanan/proses', function () {
    return view('login.kasir.pesanan-proses');
})->name('kasir.pesanan-diproses');
Route::get('/kasir/pesanan/proses', [PesananController::class, 'sedangDiproseskasir'])->name('kasir.pesanan-diproses');

// Rute untuk pesanan yang belum diproses
Route::get('/kasir/pesanan/belumdiproses', function () {
    return view('login.kasir.pesanan-belumdiproses');
})->name('kasir.pesanan-belum');
Route::get('/kasir/pesanan/belum-diproses', [PesananController::class, 'belumDiproseskasir'])->name('kasir.pesanan-belum');

// Rute untuk pesanan yang selesai
Route::get('/kasir/pesanan/selesai', function () {
    return view('login.kasir.pesanan-selesai');
})->name('kasir.pesanan-selesai');
Route::get('/kasir/pesanan/selesai', [PesananController::class, 'selesaikasir'])->name('kasir.pesanan-selesai');



//

Route::get('pesanan/create', [PesananController::class, 'create'])->name('pesanan.create');
Route::get('/kasir/input', [PesananController::class, 'create'])->name('kasir.pesanan-input'); // Gunakan controller yang benar
// Rute untuk menyimpan pesanan
Route::post('pesanan', [PesananController::class, 'store'])->name('pesanan.store');



use App\Http\Controllers\LayanannController;

Route::get('/owner-layanan/layanan', [LayanannController::class, 'index'])->name('owner.layanann.index');
Route::get('/owner/layanann', [LayanannController::class, 'index'])->name('owner.layanann.index');
Route::post('/owner/layanann', [LayanannController::class, 'store'])->name('owner.layanann.store');
Route::put('/owner/layanann/{layanann}', [LayanannController::class, 'update'])->name('owner.layanann.update');
Route::delete('/owner/layanann/{layanann}', [LayanannController::class, 'destroy'])->name('owner.layanann.destroy');
Route::get('/owner/layanann/{layanann}/edit', [LayanannController::class, 'edit'])->name('owner.layanann.edit');

Route::put('/owner/layanann/{layanann}', [LayanannController::class, 'update'])->name('owner.layanann.update');

Route::get('/layanan/satuan', [LayanannController::class, 'satuan'])->name('layanan.satuan');
Route::get('/layanan/kiloan', [LayanannController::class, 'kiloan'])->name('layanan.kiloan');
Route::get('/layanan/lainnya', [LayanannController::class, 'lainnya'])->name('layanan.lainnya');
Route::get('/layanan/sepatu', [LayanannController::class, 'sepatu'])->name('layanan.sepatu');
Route::get('/layanan/tambah', [LayanannController::class, 'create'])->name('layanan.tambah');
Route::get('/layanan/tambah', [LayanannController::class, 'create'])->name('layanan.tambah');
Route::post('/layanan/store', [LayanannController::class, 'store'])->name('layanan.store');
Route::get('/layanan/{id}/edit', [LayanannController::class, 'edit'])->name('layanan.edit');
Route::put('/layanan/{id}', [LayanannController::class, 'update'])->name('layanan.update');
Route::delete('/layanan/{id}', [LayanannController::class, 'destroy'])->name('layanan.destroy');
Route::get('/layanan', [LayanannController::class, 'index'])->name('layanan.index');

Route::get('/layanan/parfum', [LayanannController::class, 'parfum'])->name('layanan.parfum');
Route::get('/layanan/parfumcreate', [LayanannController::class, 'createParfum'])->name('parfum.create');
Route::post('/layanan/parfum/store', [LayanannController::class, 'storeParfum'])->name('parfum.store');
Route::get('/layanan/{id}/parfumedit', [LayanannController::class, 'editParfum'])->name('parfum.edit');
Route::put('/layanan/{id}/parfum', [LayanannController::class, 'updateParfum'])->name('parfum.update');
Route::delete('/layanan/{id}/parfum', [LayanannController::class, 'destroyParfum'])->name('parfum.destroy');


Route::get('/kasir/pendapatan', [PesananController::class, 'pendapatan'])->name('kasir.pendapatan');
Route::get('/owner/pendapatan', [PesananController::class, 'pendapatanowner'])->name('owner.pendapatan');

use App\Http\Controllers\CustomerController;

Route::get('/kasir/pelanggan', [CustomerController::class, 'index'])->name('pelanggan.index');
Route::get('/kasir/pelanggan/{id}', [CustomerController::class, 'show'])->name('kasir.pelanggan.detail');

Route::get('/owner/pelanggan', [CustomerController::class, 'indexowner'])->name('pelangganowner.index');
Route::get('/owner/pelanggan/{id}', [CustomerController::class, 'showowner'])->name('owner.pelanggan.detail');

Route::get('/pesanan/{id}/edit', [PesananController::class, 'edit'])->name('kasir.pesanan.edit');
Route::put('/pesanan/{id}/update', [PesananController::class, 'update'])->name('kasir.pesanan.update');


Route::get('/kasir/pengeluaran', function () {
    return view('login.kasir.pengeluaran');
})->name('kasir.pengeluaran');

Route::delete('/kasir/pesanan/{id}', [PesananController::class, 'destroy'])->name('kasir.pesanan.destroy');


use App\Http\Controllers\PengeluaranController;

Route::prefix('owner')->group(function () {
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
});


Route::prefix('kasir')->group(function () {
    Route::get('/pengeluaran', [PengeluaranController::class, 'indexowner'])->name('pengeluaranowner.index');
    Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'createowner'])->name('pengeluaranowner.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'storeowner'])->name('pengeluaranowner.store');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'editowner'])->name('pengeluaranowner.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'updateowner'])->name('pengeluaranowner.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroyowner'])->name('pengeluaranowner.destroy');
});

use App\Http\Controllers\KaryawanController;
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get   ('/karyawan/{user}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put   ('/karyawan/{user}',      [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{user}',  [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

use App\Http\Controllers\KasirDashboardController;
    Route::get('/kasir/dashboard', [KasirDashboardController::class,'index'])->name('kasir.dashboard');
    Route::put('/kasir/pesanan/{id}/update-status', [KasirDashboardController::class, 'updateStatus'])->name('kasir.pesanan.updateStatus');
    Route::get('/owner/dashboard', [KasirDashboardController::class,'indexowner'])->name('owner.dashboard');



