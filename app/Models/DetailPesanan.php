<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanann_id',
        'layanann_id',
        'nama_layanan',
        'jenis',
        'jumlah',
        'subtotal',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanann_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanann_id');
    }
}
