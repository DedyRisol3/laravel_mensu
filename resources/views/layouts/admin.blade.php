<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel MenSu</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style-admin.css') }}">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <span class="material-symbols-outlined icon-logo">content_cut</span>
                    <h1>ADMIN PANEL</h1>
                </a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}"><span class="material-symbols-outlined nav-icon">dashboard</span>Dasbor</a></li>
                    <li><a href="{{ route('admin.customers.index') }}"><span class="material-symbols-outlined nav-icon">group</span>Data Pelanggan</a></li>
                    <li><a href="{{ route('admin.orders.index') }}"><span class="material-symbols-outlined nav-icon">receipt_long</span>Data Pesanan</a></li>
                    <li><a href="#"><span class="material-symbols-outlined nav-icon">paid</span>Manajemen Pembayaran</a></li>
                    <li><a href="#"><span class="material-symbols-outlined nav-icon">local_shipping</span>Manajemen Pengantaran</a></li>
                    <li><a href="{{ route('admin.products.index') }}"><span class="material-symbols-outlined nav-icon">storefront</span>Manajemen Layanan</a></li>
                    <li><a href="#"><span class="material-symbols-outlined nav-icon">assessment</span>Laporan</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
    
    {{-- <script src="../assets/js/admin.js"></script> --}}
</body>
</html>