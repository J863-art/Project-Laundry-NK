<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');             // Contoh: 2025-05-09 16:00
            $table->string('judul');                 // Contoh: "Pembelian Parfum"
            $table->text('keterangan')->nullable();  // Contoh: "Pembelian Stok 1 bulan"
            $table->integer('jumlah');               // Contoh: 100000 (dalam rupiah)
            $table->binary('bukti')->nullable();     // Path file bukti (opsional)
            $table->timestamps();                    // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluarans');
    }
}
