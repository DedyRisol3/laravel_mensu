<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = \App\Models\Product::all();
    // Buat file 'resources/views/layanan/index.blade.php'
    // (Gunakan 'layanan.html' sbg template, ganti grid layanan dgn loop @foreach)
    return view('layanan.index', compact('products'));
}
}
