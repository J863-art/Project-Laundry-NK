<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanannTable extends Migration
{
    public function up()
    {
        Schema::create('pesanann', function (Blueprint $table) {
            $table->id(); // ID utama pesanan
            $table->string('kode_pesanan')->unique(); // Misal: #ORD-3004

            // Foreign key ke customer


            // Simpan langsung data customer (optional, karena data customer sudah ada di tabel customer)
            $table->foreignId('customernk_id')->constrained('customernk')->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('no_telepon');
            $table->foreignId('parfum_id')->constrained('parfums')->onDelete('cascade');

            // Foreign key ke layanan
            // $table->foreignId('layanann_id')->constrained('layanann')->onDelete('cascade');
            // $table->string('layanan_satuan')->nullable();
            // $table->string('jumlah_satuan')->nullable();
            // $table->string('layanan_sepatu')->nullable();
            // $table->string('jumlah_sepatu')->nullable();
            // $table->string('layanan_lainnya')->nullable();
            // $table->string('jumlah_lainnya')->nullable();
            // $table->string('layanan_kiloan')->nullable();
            $table->decimal('berat', 8, 2)->nullable(); // hanya satu kali, jangan duplikat
            $table->integer('harga_total')->nullable();
            $table->enum('status_pembayaran', ['belum_lunas', 'lunas']);
            $table->enum('metode_pembayaran', ['qris', 'cash']);
            $table->enum('status', ['belum_diproses', 'sedang_diproses', 'selesai']);
            $table->dateTime('tanggal_masuk');
            $table->dateTime('estimasi_selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanann');
    }
}
