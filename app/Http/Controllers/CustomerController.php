<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::withCount('pesanan');

        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $customers = $query->get();

        return view('login.kasir.pelanggan', compact('customers'));
    }


    public function show($id)
    {
        $customer = Customer::with('pesanan')->findOrFail($id);

        // Hitung total transaksi dan jumlah transaksi
        $jumlahTransaksi = $customer->pesanan->count();
        $totalTransaksi = $customer->pesanan->where('status_pembayaran', 'lunas')->sum('harga_total');


        return view('login.kasir.detail-pelanggan', compact('customer', 'jumlahTransaksi', 'totalTransaksi'));
    }



    //Customer untuk owner
    public function indexowner(Request $request)
    {
        $query = Customer::withCount('pesanan');

        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $customers = $query->get();

        return view('login.owner.pelanggan', compact('customers'));
    }


    public function showowner($id)
    {
        $customer = Customer::with('pesanan')->findOrFail($id);

        // Hitung total transaksi dan jumlah transaksi
        $jumlahTransaksi = $customer->pesanan->count();
        $totalTransaksi = $customer->pesanan->where('status_pembayaran', 'lunas')->sum('harga_total');


        return view('login.owner.detail-pelanggan', compact('customer', 'jumlahTransaksi', 'totalTransaksi'));
    }


}
