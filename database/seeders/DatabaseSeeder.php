<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Menghapus data sebelumnya dan mengisi ulang data
        //User::factory(3)->create();  // Menggunakan factory untuk membuat user secara otomatis

        // Menambahkan satu akun kasir
        User::create([
            'name' => 'Kasir User',
            'username' => 'Kasir123',
            'email' => 'kasir@example.com',
            'password' => bcrypt('123456'), // Gunakan password yang sesuai
            'role' => 'kasir'  // Role yang diinginkan
        ]);

        // Menambahkan satu akun pemilik
        User::create([
            'name' => 'Pemilik User',
            'username' => 'Pemilik123',
            'email' => 'pemilik@example.com',
            'password' => bcrypt(value: '12345'), // Gunakan password yang sesuai
            'role' => 'pemilik'  // Role yang diinginkan
        ]);

        User::create([
            'name' => 'Januar',
            'username' => 'juntak86',
            'email' => 'januarsimanjuntak86@gmail.com',
            'password' => bcrypt(value: '12121212'), // Gunakan password yang sesuai
            'role' => 'pemilik'  // Role yang diinginkan
        ]);
    }
}
