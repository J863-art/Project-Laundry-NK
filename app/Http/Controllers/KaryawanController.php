<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KaryawanController extends Controller
{
    /** Tampilkan semua karyawan */
    public function index(Request $request)
    {
        // Ambil query pencarian jika ada
        $search = $request->query('search');

        $users = User::when($search, function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    // Ganti 'kasir' jika ingin menampilkan semua role
                    // ->where('role', 'kasir','owner')
                    ->latest()
                    ->get();

        return view('login.daftarkaryawan.karyawan', compact('users', 'search'));
    }

    /** Form tambah karyawan */
    public function create()
    {
        return view('login.daftarkaryawan.tambah-karyawan');
    }

    /** Simpan karyawan baru */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'username'              => 'required|string|alpha_dash|unique:users,username',
            'no_telp'               => 'nullable|string|max:20',
            'email'                 => 'nullable|email|unique:users,email',
            'password'              => 'required|confirmed|min:6',
            'role'                  => 'required|in:kasir,pemilik', // ← tambah validasi role
        ]);





        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Foto & kolom lain biarkan null dulu
        User::create($validated);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        // Form edit: lempar data user ke view
        return view('login.daftarkaryawan.edit-karyawan', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => "required|string|alpha_dash|unique:users,username,{$user->id}",
            'no_telp'  => 'nullable|string|max:20',
            'email'    => "nullable|email|unique:users,email,{$user->id}",
            'role'     => 'required|in:kasir,pemilik',
            'password' => 'nullable|confirmed|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);   // jangan timpa password jika kosong
        }

        $user->update($validated);

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil diperbarui.');
    }



    /** Hapus karyawan (opsional) */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Karyawan berhasil dihapus.');
    }
}
