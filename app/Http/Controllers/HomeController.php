<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Ganti 'return "Welcome to MenSu";' dengan:
    return view('welcome');
}
// Tambahkan juga method untuk halaman statis
public function tentang() { return view('tentang'); } // Anda harus buat file 'tentang.blade.php'
public function kontak() { return view('kontak'); } // Anda harus buat file 'kontak.blade.php'
public function pengantaran() { return view('pengantaran'); } // Anda harus buat file 'pengantaran.blade.php'
}
