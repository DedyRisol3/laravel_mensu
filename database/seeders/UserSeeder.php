<?php

namespace Database\Seeders;

// database/seeders/UserSeeder.php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'fullname' => 'mensu',
            'email' => 'admin@mensu.com',
            'no_hp' => '081234567001',
            'alamat' => 'Kantor Pusat MenSu',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // 2. Akun Pelanggan (Dummy)
        User::create([
            'fullname' => 'fadli',
            'email' => 'pelanggan@fadli.com',
            'no_hp' => '081234567002',
            'alamat' => 'Jl. Sudirman No. 123',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
            'email_verified_at' => now()
        ]);

        // 3. Akun Kurir
        User::create([
            'fullname' => 'Tegar',
            'email' => 'kurir@tegar.com',
            'no_hp' => '081234567003',
            'alamat' => 'Basecamp Kurir',
            'password' => Hash::make('password'),
            'role' => 'kurir',
            'email_verified_at' => now()
        ]);
    }
}