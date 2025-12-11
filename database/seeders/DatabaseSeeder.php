<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@umkm.com',
            'password' => Hash::make('password'), // Passwordnya 'password'
            'role' => 'admin',
        ]);

        // 2. Buat Akun Reseller Contoh
        User::create([
            'name' => 'Reseller Semangat',
            'email' => 'reseller@umkm.com',
            'password' => Hash::make('password'),
            'role' => 'reseller',
        ]);
    }
}