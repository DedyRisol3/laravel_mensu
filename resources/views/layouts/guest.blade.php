<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MenSu - Project Jahit Jas')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- CSS Files --}}
    {{-- PASTIKAN MENGGUNAKAN {{ asset(...) }} --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-auth.css') }}">

    {{-- Jika halaman lain (misal: ukuran) butuh CSS spesifik, bisa tambahkan @stack --}}
    @stack('styles')

</head>
<body class="antialiased"> {{-- Tambahkan class Tailwind dasar jika perlu --}}
    <header class="bg-white border-b border-gray-100"> {{-- Contoh styling header dasar --}}
        <div class="container mx-auto flex justify-between items-center py-4 px-6"> {{-- Contoh container --}}
            <div class="logo flex items-center font-bold text-lg text-gray-800">
                <span class="material-symbols-outlined text-yellow-600 mr-2">content_cut</span>
                <h1>PROJECT JAHIT JAS</h1>
            </div>
            <nav class="hidden md:flex space-x-6"> {{-- Navigasi, sembunyikan di layar kecil --}}
                {{-- Gunakan kelas Tailwind untuk styling link --}}
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-medium">Beranda</a>
                <a href="{{ route('layanan.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Layanan</a>
                <a href="{{ route('pengantaran') }}" class="text-gray-600 hover:text-gray-900 font-medium">Pengantaran</a>
                <a href="{{ route('tentang') }}" class="text-gray-600 hover:text-gray-900 font-medium">Tentang Kami</a>
                <a href="{{ route('kontak') }}" class="text-gray-600 hover:text-gray-900 font-medium">Kontak</a>
            </nav>
            <div class="header-actions flex items-center">
                @guest
                    {{-- Tombol Masuk dengan styling Tailwind --}}
                    <a href="{{ route('login') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Masuk</a>
                @else
                    {{-- Tombol Dashboard --}}
                     <a href="{{ route('dashboard') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Dashboard</a>
                @endguest
                {{-- Hamburger Menu (jika diperlukan untuk mobile) --}}
                {{-- <button class="md:hidden ml-4">...</button> --}}
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-center py-6 mt-12"> {{-- Contoh styling footer --}}
        <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Project Jahit Jas. Semua Hak Cipta Dilindungi.</p>
    </footer>

    {{-- Hapus pemanggilan JS lama jika tidak diperlukan --}}
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}

    {{-- Tempat untuk script spesifik halaman --}}
    @stack('scripts')
</body>
</html>