<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Menetapkan nama tabel yang sesuai
    protected $table = 'customernk'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['full_name', 'phone_number', 'address'];

    // Relasi dengan Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'customernk_id');
    }
}

