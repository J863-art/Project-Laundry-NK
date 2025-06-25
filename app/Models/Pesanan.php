<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Menetapkan nama tabel yang sesuai
    protected $table = 'pesanann'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
       'kode_pesanan',
        'customernk_id',
        'nama_pelanggan',
        'no_telepon',
        'layanann_id',
        'parfum_id',
        'layanan_satuan',
        'jumlah_satuan',
        'layanan_sepatu',
        'jumlah_sepatu',
        'layanan_lainnya',
        'jumlah_lainnya',
        'layanan_kiloan',
        'berat',
        'harga_total',
        'status_pembayaran',
        'metode_pembayaran',
        'status',
        'tanggal_masuk',
        'estimasi_selesai',
    ];

    // Relasi dengan Customer
    // App\Models\Pesanan.php

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customernk_id');
    }

    // Relasi dengan Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanann_id');
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanann_id');
    }

    public function parfum()
    {
        return $this->belongsTo(Parfum::class);
    }


}

