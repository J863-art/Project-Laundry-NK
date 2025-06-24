<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesanansTable extends Migration
{
    public function up()
    {
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanann_id')->constrained('pesanann')->onDelete('cascade');
            $table->unsignedBigInteger('layanann_id')->nullable();
            $table->foreign('layanann_id')->references('id')->on('layanann')->onDelete('set null');

            $table->string('nama_layanan');
            $table->string('jenis');
            $table->decimal('jumlah', 8, 2)->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pesanans');
    }
}
