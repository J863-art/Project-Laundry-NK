<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanannTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanann', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan'); // Contoh: "Cuci Kering", "Setrika"
            $table->integer('harga');       // Contoh: 5000 (untuk Rp 5.000)
            $table->enum('jenis', ['Laundry_Satuan', 'Laundry_Kiloan', 'Laundry_Lainnya', 'Laundry_sepatu']);
            $table->enum('tipe', ['Regular', 'Express'])->default('Regular'); // Label seperti "Express" atau "Regular"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanann');
    }
}
