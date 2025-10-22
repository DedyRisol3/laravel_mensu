<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MenSu - Project Jahit Jas')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-auth.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <span class="material-symbols-outlined icon-logo">content_cut</span>
            <h1>PROJECT JAHIT JAS</h1>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('layanan.index') }}">Layanan</a></li>
                <li><a href="{{ route('pengantaran') }}">Pengantaran</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </nav>
        <div class="header-actions" id="header-actions">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            @endguest
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Project Jahit Jas. Semua Hak Cipta Dilindungi.</p>
    </footer>

    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
</body>
</html>