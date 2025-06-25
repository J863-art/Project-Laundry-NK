<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Customer;
use App\Models\Layanan;
use App\Models\DetailPesanan;
use App\Models\Parfum;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::query();

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*'); // penting agar model tetap bisa digunakan
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

       $pesanans = $query->with(['customer', 'detailPesanans'])->get();

        return view('login.owner.semua-pesanan', compact('pesanans'));
    }



    public function belumDiproses(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'belum_diproses') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.owner.pesanan-belumdiproses', compact('pesanans'));
    }


    public function sedangDiproses(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'sedang_diproses') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.owner.pesanan-proses', compact('pesanans'));
    }

    public function selesai(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'selesai') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.owner.pesanan-selesai', compact('pesanans'));
    }

     public function create()
    {
        $customers = Customer::select('full_name', 'phone_number')->get();
        $layanans = Layanan::all();
        $parfums = Parfum::all(); // ambil semua parfum

        return view('login.kasir.input', compact('customers', 'layanans', 'parfums'));
    }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'nama_pelanggan'   => 'required|string|max:255',
                'no_telepon'       => 'required|string|max:15',
                'layanan_id'       => 'required|array',
                'layanan_id.*'     => 'nullable|exists:layanann,id',

                'berat.*'          => 'nullable|numeric',
                'jumlah_sepatu.*'  => 'nullable|numeric',
                'jumlah_satuan.*'  => 'nullable|numeric',
                'jumlah_lainnya.*' => 'nullable|numeric',

                'status_pembayaran'=> 'required|in:belum_lunas,lunas',
                'metode_pembayaran' => 'required|in:qris,cash',
                'status'           => 'required|in:belum_diproses,sedang_diproses,selesai',
                'estimasi_selesai' => 'required|date_format:Y-m-d\TH:i',
                'parfum_id'        => 'nullable|exists:parfums,id',
            ]);

            /* ----------  Ambil (atau buat) pelanggan  ---------- */
            $customer = Customer::firstOrCreate(
                ['phone_number' => $validated['no_telepon']],
                ['full_name'    => $validated['nama_pelanggan'],
                'address'      => null]
            );

            /* ----------  Persiapan array kuantitas  ---------- */
            $beratArr     = $request->input('berat',           []);
            $sepatuArr    = $request->input('jumlah_sepatu',   []);
            $satuanArr    = $request->input('jumlah_satuan',   []);
            $lainnyaArr   = $request->input('jumlah_lainnya',  []);

            $totalHarga     = 0;
            $detailPesanans = [];

            foreach ($validated['layanan_id'] as $index => $layananId) {
                if (!$layananId) continue;

                $layanan = Layanan::find($layananId);
                if (!$layanan) continue;

                /* ----------  Dapatkan jumlah sesuai jenis  ---------- */
                $jumlah = match ($layanan->jenis) {
                    'Laundry_Kiloan'  => floatval($beratArr[$index]    ?? 0),
                    'Laundry_sepatu'  => floatval($sepatuArr[$index]   ?? 0),
                    'Laundry_Satuan'  => floatval($satuanArr[$index]   ?? 0),
                    'Laundry_Lainnya' => floatval($lainnyaArr[$index]  ?? 0),
                    default           => 0,
                };

                $subtotal   = $layanan->harga * $jumlah;
                $totalHarga += $subtotal;

                $detailPesanans[] = [
                    'layanann_id'  => $layanan->id,
                    'nama_layanan' => $layanan->nama_layanan,
                    'jenis'        => $layanan->jenis,
                    'jumlah'       => $jumlah,
                    'subtotal'     => $subtotal,
                ];
            }

            /* ----------  Simpan pesanan & detail  ---------- */
            $pesanan = Pesanan::create([
                'kode_pesanan'      => 'ORD-' . Str::upper(Str::random(6)),
                'customernk_id'     => $customer->id,
                'nama_pelanggan'    => $validated['nama_pelanggan'],
                'no_telepon'        => $validated['no_telepon'],
                'status'            => $validated['status'],
                'status_pembayaran' => $validated['status_pembayaran'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'tanggal_masuk'     => now(),
                'estimasi_selesai'  => $validated['estimasi_selesai'],
                'harga_total'       => $totalHarga,
                'parfum_id'         => $validated['parfum_id'] ?? null,
            ]);

            $pesanan->detailPesanans()->createMany($detailPesanans);

            return redirect()->route('kasir.pesanan')
                            ->with('success', 'Pesanan berhasil disimpan!');
        }








        public function indexkasir(Request $request)
        {
            $query = Pesanan::query();

            // Pencarian berdasarkan nama customer
            if ($request->filled('search')) {
                $query->whereHas('customer', function ($q) use ($request) {
                    $q->where('full_name', 'like', '%' . $request->search . '%');
                });
            }

            // Sorting
            switch ($request->sort) {
                case 'nama':
                    $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                        ->orderBy('customernk.full_name')
                        ->select('pesanann.*'); // penting agar model tetap bisa digunakan
                    break;

                case 'terbaru':
                    $query->orderBy('tanggal_masuk', 'desc');
                    break;

                case 'terlama':
                    $query->orderBy('tanggal_masuk', 'asc');
                    break;

                case 'proses':
                    $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                    break;

                default:
                    $query->orderBy('tanggal_masuk', 'desc');
                    break;
            }

            $pesanans = $query->with(['customer', 'layanan'])->get();

            return view('login.kasir.semua-pesanan', compact('pesanans'));
        }



    public function belumDiproseskasir(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'belum_diproses') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.kasir.pesanan-belumdiproses', compact('pesanans'));
    }


    public function sedangDiproseskasir(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'sedang_diproses') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.kasir.pesanan-proses', compact('pesanans'));
    }

    public function selesaikasir(Request $request)
    {
        $query = Pesanan::query()
            ->where('status', 'selesai') // filter hanya 'belum_diproses'
            ->with(['customer', 'layanan']);

        // Pencarian berdasarkan nama customer
        if ($request->filled('search')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama':
                $query->join('customernk', 'pesanann.customernk_id', '=', 'customernk.id')
                    ->orderBy('customernk.full_name')
                    ->select('pesanann.*');
                break;

            case 'terbaru':
                $query->orderBy('tanggal_masuk', 'desc');
                break;

            case 'terlama':
                $query->orderBy('tanggal_masuk', 'asc');
                break;

            case 'proses':
                $query->orderByRaw("FIELD(status, 'belum_diproses', 'sedang_diproses', 'selesai')");
                break;

            default:
                $query->orderBy('tanggal_masuk', 'desc');
                break;
        }

        $pesanans = $query->get();

        return view('login.kasir.pesanan-selesai', compact('pesanans'));
    }

    public function createkasir()
    {
        // Ambil semua layanan untuk dropdown
        $layanans = Layanan::all();  // Mendapatkan semua data layanan dari tabel 'layanann'

        // Mengirimkan data layanan ke view
        return view('login.kasir.input', compact('layanans'));
    }



    public function storekasir(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'layanan_id' => 'required|exists:layanann,id',
            'berat' => 'required|numeric',
        ]);

        // Insert customer data into customernk table if not already present
        $customer = Customer::firstOrCreate(
            ['phone_number' => $validated['no_telepon']], // Find customer by phone number
            ['full_name' => $validated['nama_pelanggan'], 'address' => null] // Insert name and phone if not found
        );

        // Create pesanan in the pesanann table, directly using customer data
        $pesanan = Pesanan::create([
            'kode_pesanan' => 'ORD-' . Str::random(6),
            'customernk_id' => $customer->id, // ⬅️ tambahkan baris ini
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'no_telepon' => $validated['no_telepon'],
            'layanann_id' => $validated['layanan_id'],
            'berat' => $validated['berat'],
            'status' => 'belum_diproses',
            'tanggal_masuk' => now(),
            'estimasi_selesai' => now()->addDays(3),
        ]);


        return redirect()->route('pesanan.create')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function pendapatan(Request $request)
    {
        $filter  = $request->input('filter', 'pemasukan'); // default: pemasukan
        $periode = $request->input('periode', 'all');      // default: semua

        $query = Pesanan::with('layanan')->orderBy('tanggal_masuk', 'desc');

        // Filter berdasarkan status pembayaran
        if ($filter === 'pemasukan') {
            $query->where('status_pembayaran', 'lunas');
        }

        // Filter berdasarkan periode waktu
        $now = Carbon::now();
        switch ($periode) {
            case 'today':
                $query->whereDate('tanggal_masuk', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('tanggal_masuk', [
                    $now->copy()->startOfWeek()->startOfDay(),  // Senin 00:00:00
                    $now->copy()->endOfWeek()->endOfDay(),      // Minggu 23:59:59
                ]);
                break;
            case 'month':
                $query->whereMonth('tanggal_masuk', $now->month)->whereYear('tanggal_masuk', $now->year);
                break;
            case 'year':
                $query->whereYear('tanggal_masuk', $now->year);
                break;
            case 'all':
            default:
                // tidak ada filter tambahan
                break;
        }

        $pesanans = $query->get();
        $totalPendapatan = $pesanans->sum('harga_total');

        return view('login.kasir.pendapatan', compact('pesanans', 'totalPendapatan'));
    }

    public function pendapatanowner(Request $request)
    {
        $filter  = $request->input('filter', 'pemasukan'); // default: pemasukan
        $periode = $request->input('periode', 'all');      // default: semua

        $query = Pesanan::with('layanan')->orderBy('tanggal_masuk', 'desc');

        // Filter berdasarkan status pembayaran
        if ($filter === 'pemasukan') {
            $query->where('status_pembayaran', 'lunas');
        }

        // Filter berdasarkan periode waktu
        $now = Carbon::now();
        switch ($periode) {
            case 'today':
                $query->whereDate('tanggal_masuk', $now->toDateString());
                break;
            case 'week':
                $query->whereBetween('tanggal_masuk', [
                    $now->copy()->startOfWeek()->startOfDay(),  // Senin 00:00:00
                    $now->copy()->endOfWeek()->endOfDay(),      // Minggu 23:59:59
                ]);
                break;
            case 'month':
                $query->whereMonth('tanggal_masuk', $now->month)->whereYear('tanggal_masuk', $now->year);
                break;
            case 'year':
                $query->whereYear('tanggal_masuk', $now->year);
                break;
            case 'all':
            default:
                // tidak ada filter tambahan
                break;
        }

        $pesanans = $query->get();
        $totalPendapatan = $pesanans->sum('harga_total');

        return view('login.owner.pendapatan', compact('pesanans', 'totalPendapatan'));
    }



    public function edit($id)
    {
        // Ambil pesanan + detail_pesanan
        $pesanan   = Pesanan::with('detailPesanans')->findOrFail($id);

        // Data dropdown
        $customers = Customer::select('full_name', 'phone_number')->get();
        $layanans  = Layanan::all();
        $parfums   = Parfum::all();

        return view(
            'login.kasir.pesanan-edit',
            compact('pesanan', 'customers', 'layanans', 'parfums')
        );
    }

    /* ---------- UPDATE ---------- */
    public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'nama_pelanggan'   => 'required|string|max:255',
        'no_telepon'       => 'required|string|max:15',
        'layanan_id'       => 'required|array',
        'layanan_id.*'     => 'exists:layanann,id',
        'jumlah'           => 'required|array',
        'jumlah.*'         => 'numeric|min:0',
        'status_pembayaran'=> 'required|in:belum_lunas,lunas',
        'status'           => 'required|in:belum_diproses,sedang_diproses,selesai',
        'estimasi_selesai' => 'required|date_format:Y-m-d\TH:i',
        'parfum_id'        => 'nullable|exists:parfums,id',
    ]);

    // Ambil pesanan
    $pesanan = Pesanan::with('detailPesanans')->findOrFail($id);

    // Ambil / Buat customer
    $customer = Customer::firstOrCreate(
        ['phone_number' => $validated['no_telepon']],
        ['full_name' => $validated['nama_pelanggan'], 'address' => null]
    );

    // Hitung ulang total harga & siapkan detail baru
    $totalHarga = 0;
    $detailPesanans = [];

    foreach ($validated['layanan_id'] as $index => $layananId) {
        $layanan = Layanan::find($layananId);
        if (!$layanan) continue;

        $jumlah   = $validated['jumlah'][$index] ?? 0;
        $subtotal = $layanan->harga * $jumlah;
        $totalHarga += $subtotal;

        $detailPesanans[] = [
            'layanann_id'  => $layanan->id,
            'nama_layanan' => $layanan->nama_layanan,
            'jenis'        => $layanan->jenis,
            'jumlah'       => $jumlah,
            'subtotal'     => $subtotal,
        ];
    }

    // Update data pesanan
    $pesanan->update([
        'customernk_id'     => $customer->id,
        'nama_pelanggan'    => $validated['nama_pelanggan'],
        'no_telepon'        => $validated['no_telepon'],
        'status'            => $validated['status'],
        'status_pembayaran' => $validated['status_pembayaran'],
        'estimasi_selesai'  => $validated['estimasi_selesai'],
        'harga_total'       => $totalHarga,
        // 'parfum_id'         => $validated['parfum_id'],
    ]);

    // Sinkronisasi ulang detail
    $pesanan->detailPesanans()->delete();
    $pesanan->detailPesanans()->createMany($detailPesanans);

    return redirect()
        ->route('kasir.pesanan', $pesanan->id)
        ->with('success', 'Pesanan berhasil diperbarui!');
}





    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('kasir.pesanan')->with('success', 'Pesanan berhasil dihapus.');
    }



    }
