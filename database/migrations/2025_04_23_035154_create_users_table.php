<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('username')->unique(); // Bisa digunakan untuk login
            $table->string('email')->unique()->nullable(); // Optional
            $table->string('no_telp')->nullable();
            $table->string('password');
            $table->enum('role', ['pemilik', 'kasir']); // Role login
            $table->string('foto')->nullable(); // Foto profil opsional
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

