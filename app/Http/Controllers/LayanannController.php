<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Parfum;
use Illuminate\Http\Request;

class LayanannController extends Controller
{
    public function index(Request $request)
    {
        $query = Layanan::query();

        if ($request->has('search')) {
            $query->where('nama_layanan', 'like', '%' . $request->search . '%');
        }

        $layanans = $query->orderBy('created_at', 'desc')->get();

        return view('login.owner-layanan.layanan', compact('layanans'));
    }

    public function satuan()
    {
        // Ambil data layanan dengan jenis 'Laundry_Satuan'
        $layanans = Layanan::where('jenis', 'Laundry_Satuan')->orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('login.owner-layanan.satuan', compact('layanans'));
    }


    public function kiloan()
    {
        // Ambil data layanan dengan jenis 'Laundry_Satuan'
        $layanans = Layanan::where('jenis', 'Laundry_Kiloan')->orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('login.owner-layanan.kiloan', compact('layanans'));
    }


    public function lainnya()
    {
        // Ambil data layanan dengan jenis 'Laundry_Satuan'
        $layanans = Layanan::where('jenis', 'Laundry_Lainnya')->orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('login.owner-layanan.lainnya', compact('layanans'));
    }

    public function sepatu()
    {
        // Ambil data layanan dengan jenis 'Laundry_Satuan'
        $layanans = Layanan::where('jenis', 'Laundry_Sepatu')->orderBy('created_at', 'desc')->get();

        // Kirim data ke view
        return view('login.owner-layanan.sepatu', compact('layanans'));
    }

    public function parfum()
    {
        $parfums = Parfum::all(); // ambil semua data parfum dari DB
        return view('login.owner-layanan.parfum', compact('parfums'));
    }

    public function createParfum()
    {
        return view('login.owner-layanan.parfumcreate');
    }

    public function storeParfum(Request $request)
    {
        $request->validate([
            'nama_parfum' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Parfum::create([
            'nama_parfum' => $request->nama_parfum,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('layanan.parfum')->with('success', 'Parfum berhasil ditambahkan.');
    }

    public function editParfum($id)
    {
        $parfums = Parfum::findOrFail($id);
        return view('login.owner-layanan.parfumedit', compact('parfums'));
    }

    public function updateParfum(Request $request, $id)
    {
        $request->validate([
            'nama_parfum' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $parfums = Parfum::findOrFail($id);
        $parfums->update([
            'nama_parfum' => $request->nama_parfum,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('layanan.parfum')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroyParfum($id)
    {
        $parfums = Parfum::findOrFail($id);
        $parfums->delete();

        return redirect()->route('layanan.parfum')->with('success', 'Layanan berhasil dihapus!');
    }


    public function create()
    {
        return view('login.owner-layanan.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Laundry_Satuan,Laundry_Kiloan,Laundry_Lainnya,Laundry_sepatu',
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        Layanan::create([
            'jenis' => $request->jenis,
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'tipe' => 'Regular',
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('login.owner-layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Laundry_Satuan,Laundry_Kiloan,Laundry_Lainnya,Laundry_Sepatu',
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update([
            'jenis' => $request->jenis,
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }

}
