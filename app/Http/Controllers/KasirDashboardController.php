<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Pesanan;
use App\Models\Customer;
use Carbon\Carbon;


class KasirDashboardController extends Controller
{
    public function index()
    {
        $today     = Carbon::today();
        $yesterday = $today->copy()->subDay();

        /* ================== RINGKASAN ================== */
        $todayOrders     = Pesanan::whereDate('tanggal_masuk', $today)->count();
        $ydayOrders      = Pesanan::whereDate('tanggal_masuk', $yesterday)->count();
        $orderGrowthPct  = $ydayOrders ? (($todayOrders - $ydayOrders) / $ydayOrders) * 100 : null;

        $todayRevenue     = Pesanan::whereDate('tanggal_masuk', $today)->sum('harga_total');
        $ydayRevenue      = Pesanan::whereDate('tanggal_masuk', $yesterday)->sum('harga_total');
        $revenueGrowthPct = $ydayRevenue ? (($todayRevenue - $ydayRevenue) / $ydayRevenue) * 100 : null;

        $ordersInProcess = Pesanan::where('status', 'sedang_diproses')->count();

        // Revisi: Tidak menggunakan kolom tanggal_diantar
        $awaitingPickup = Pesanan::where('status', 'selesai')->count();

        $newCustomers = Customer::whereMonth('created_at', $today->month)
                                ->whereYear('created_at', $today->year)
                                ->count();

        /* ================== PESANAN TERBARU ================== */
        $search = request('search');

        $query = Pesanan::query()
            ->when($search, function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%{$search}%")
                ->orWhere('kode_pesanan', 'like', "%{$search}%");
            });

        $latestOrders = $search ? $query->latest()->get() : $query->latest()->take(5)->get();



        /* ================== DATA GRAFIK MINGGU INI ================== */
        $startWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $weekly    = collect();
        $max       = 0;

        for ($d = $startWeek->copy(); $d->lt($startWeek->copy()->addDays(7)); $d->addDay()) {
            $amt = Pesanan::whereDate('tanggal_masuk', $d)->sum('harga_total');
            $weekly->push([
                'label'  => $d->locale('id')->isoFormat('ddd'),
                'amount' => $amt
            ]);
            $max = max($max, $amt);
        }

        $maxHeight = 40; // px pada view
        $weekly    = $weekly->map(function ($row) use ($max, $maxHeight) {
            $row['height'] = $max ? ($row['amount'] / $max) * $maxHeight : 2;
            return $row;
        });

        $totalWeek     = $weekly->sum('amount');
        $prevWeekTotal = Pesanan::whereBetween('tanggal_masuk', [
                                $startWeek->copy()->subWeek(),
                                $startWeek->copy()->subDay()
                          ])->sum('harga_total');
        $weekGrowthPct = $prevWeekTotal ? (($totalWeek - $prevWeekTotal) / $prevWeekTotal) * 100 : null;

        return view('login.kasir.kasirdashboard', compact(
            'todayOrders',   'orderGrowthPct',
            'todayRevenue',  'revenueGrowthPct',
            'ordersInProcess','awaitingPickup',
            'newCustomers',  'latestOrders',
            'weekly',        'totalWeek', 'weekGrowthPct'
        ));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'status_pembayaran' => 'required|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->status_pembayaran = $request->status_pembayaran;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }





     public function indexowner()
    {
        $today     = Carbon::today();
        $yesterday = $today->copy()->subDay();

        /* ================== RINGKASAN ================== */
        $todayOrders     = Pesanan::whereDate('tanggal_masuk', $today)->count();
        $ydayOrders      = Pesanan::whereDate('tanggal_masuk', $yesterday)->count();
        $orderGrowthPct  = $ydayOrders ? (($todayOrders - $ydayOrders) / $ydayOrders) * 100 : null;

        $todayRevenue     = Pesanan::whereDate('tanggal_masuk', $today)->sum('harga_total');
        $ydayRevenue      = Pesanan::whereDate('tanggal_masuk', $yesterday)->sum('harga_total');
        $revenueGrowthPct = $ydayRevenue ? (($todayRevenue - $ydayRevenue) / $ydayRevenue) * 100 : null;

        $ordersInProcess = Pesanan::where('status', 'sedang_diproses')->count();

        // Revisi: Tidak menggunakan kolom tanggal_diantar
        $awaitingPickup = Pesanan::where('status', 'selesai')->count();

        $newCustomers = Customer::whereMonth('created_at', $today->month)
                                ->whereYear('created_at', $today->year)
                                ->count();

        /* ================== PESANAN TERBARU ================== */
        $latestOrders = Pesanan::latest()->take(5)->get();

        /* ================== DATA GRAFIK MINGGU INI ================== */
        $startWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
        $weekly    = collect();
        $max       = 0;

        for ($d = $startWeek->copy(); $d->lt($startWeek->copy()->addDays(7)); $d->addDay()) {
            $amt = Pesanan::whereDate('tanggal_masuk', $d)->sum('harga_total');
            $weekly->push([
                'label'  => $d->locale('id')->isoFormat('ddd'),
                'amount' => $amt
            ]);
            $max = max($max, $amt);
        }

        $maxHeight = 40; // px pada view
        $weekly    = $weekly->map(function ($row) use ($max, $maxHeight) {
            $row['height'] = $max ? ($row['amount'] / $max) * $maxHeight : 2;
            return $row;
        });

        $totalWeek     = $weekly->sum('amount');
        $prevWeekTotal = Pesanan::whereBetween('tanggal_masuk', [
                                $startWeek->copy()->subWeek(),
                                $startWeek->copy()->subDay()
                          ])->sum('harga_total');
        $weekGrowthPct = $prevWeekTotal ? (($totalWeek - $prevWeekTotal) / $prevWeekTotal) * 100 : null;

        return view('login.ownerdashboard', compact(
            'todayOrders',   'orderGrowthPct',
            'todayRevenue',  'revenueGrowthPct',
            'ordersInProcess','awaitingPickup',
            'newCustomers',  'latestOrders',
            'weekly',        'totalWeek', 'weekGrowthPct'
        ));
    }

}
