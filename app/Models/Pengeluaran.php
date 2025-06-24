<?php

// app/Models/Pengeluaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = ['judul', 'keterangan', 'jumlah', 'tanggal', 'bukti'];
}

