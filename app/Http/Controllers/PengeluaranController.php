<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal', 'desc')->get();
        return view('login.kasir.pengeluaran', compact('pengeluarans'));
    }

    public function create()
    {
        return view('login.kasir.tambah-pengeluaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|image|mimes:png|max:2048' // hanya PNG max 2MB
        ]);

        $data = $request->only(['judul', 'keterangan', 'jumlah', 'tanggal']);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileContent = file_get_contents($file);
            $data['bukti'] = $fileContent; // simpan ke kolom BLOB
        }

        Pengeluaran::create($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('login.kasir.edit-pengeluaran', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|image|mimes:png|max:2048'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $data = $request->only(['judul', 'keterangan', 'jumlah', 'tanggal']);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileContent = file_get_contents($file);
            $data['bukti'] = $fileContent;
        }

        $pengeluaran->update($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil dihapus.');
    }




// Dibawah ini controller pengeluaran buat owner
public function indexowner()
    {
        $pengeluarans = Pengeluaran::orderBy('tanggal', 'desc')->get();
        return view('login.owner.pengeluaran', compact('pengeluarans'));
    }

    public function createowner()
    {
        return view('login.owner.tambah-pengeluaran');
    }

    public function storeowner(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|image|mimes:png|max:2048' // hanya PNG max 2MB
        ]);

        $data = $request->only(['judul', 'keterangan', 'jumlah', 'tanggal']);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileContent = file_get_contents($file);
            $data['bukti'] = $fileContent; // simpan ke kolom BLOB
        }

        Pengeluaran::create($data);

        return redirect()->route('pengeluaranowner.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function editowner($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('login.owner.edit-pengeluaran', compact('pengeluaran'));
    }

    public function updateowner(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'bukti' => 'nullable|image|mimes:png|max:2048'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $data = $request->only(['judul', 'keterangan', 'jumlah', 'tanggal']);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $fileContent = file_get_contents($file);
            $data['bukti'] = $fileContent;
        }

        $pengeluaran->update($data);

        return redirect()->route('pengeluaranowner.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroyowner($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaranowner.index')->with('success', 'Data berhasil dihapus.');
    }
}
