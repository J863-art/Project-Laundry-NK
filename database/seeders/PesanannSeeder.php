<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanann; // Jika menggunakan Eloquent
use App\Models\Customernk; // Jika menggunakan Eloquent
use Illuminate\Support\Str;

class PesanannSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan customer terlebih dahulu jika belum ada
        $customer = Customernk::create([
            'full_name' => 'John Doe',
            'phone_number' => '081234567890',
            'address' => 'Jl. Raya No. 1',
        ]);

        // Setelah customer ditambahkan, menambahkan pesanan ke tabel pesanan
        Pesanann::create([
            'kode_pesanan' => 'ORD-' . Str::random(4),
            'customernk_id' => $customer->id, // Menghubungkan dengan customer yang baru ditambahkan
            'nama_pelanggan' => $customer->full_name,
            'no_telepon' => $customer->phone_number,
            'layanan' => 'Cuci + Setrika', // Misalnya layanan yang dipilih
            'berat' => 2.5,
            'status' => 'belum_diproses',
            'tanggal_masuk' => now(),
            'estimasi_selesai' => now()->addHours(24),
        ]);
    }
}
