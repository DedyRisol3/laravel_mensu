<?php

namespace Database\Seeders;

// database/seeders/ProductSeeder.php
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'nama' => 'Wedding Premier Suit',
            'deskripsi' => 'Setelan jas premium untuk hari pernikahan Anda, dibuat dengan bahan wol terbaik.',
            'harga' => 4500000,
            'gambar_url' => 'https://via.placeholder.com/400x300.png?text=Wedding+Suit',
            'fitur' => 'Bahan Wol Premium|Full Furing|Custom Fit'
        ]);

        Product::create([
            'nama' => 'Business Essential Suit',
            'deskripsi' => 'Tampil profesional dengan setelan jas bisnis yang elegan dan nyaman.',
            'harga' => 2500000,
            'gambar_url' => 'https://via.placeholder.com/400x300.png?text=Business+Suit',
            'fitur' => 'Bahan Semi-Wol|Slim Fit|2 Kancing'
        ]);
    }
}