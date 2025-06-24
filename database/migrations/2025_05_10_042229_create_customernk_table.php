<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomernkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customernk', function (Blueprint $table) {
            $table->id(); // Kolom ID Customer
            $table->string('full_name'); // Nama lengkap customer
            $table->string('phone_number'); // Nomor telepon customer
            $table->string('address')->nullable(); // Alamat customer (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customernk');
    }
}
