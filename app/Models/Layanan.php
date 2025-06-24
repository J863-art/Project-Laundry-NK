<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'layanann'; // Pastikan ini sesuai dengan nama tabel yang ada di database

    protected $fillable = [
        'nama_layanan', 'harga','jenis',
    ];

    // protected $casts = [
    // 'jenis' => 'array',
    // ];


    // Relasi dengan Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}

