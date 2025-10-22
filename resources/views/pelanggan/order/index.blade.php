<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Project Jahit Jas</title>
    <link rel="stylesheet" href="../assets/css/style-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="../index.html" class="logo">
                    <span class="material-symbols-outlined icon-logo">content_cut</span>
                    <h1>PROJECT JAHIT JAS</h1>
                </a>
            </div>
            <nav class="sidebar-nav">
    <ul>
        <li><a href="dashboard.html"><span class="material-symbols-outlined nav-icon">dashboard</span>Dasbor</a></li>
        <li><a href="pesanan.html"><span class="material-symbols-outlined nav-icon">receipt_long</span>Pesanan Saya</a></li>
        <li><a href="pembayaran.html"><span class="material-symbols-outlined nav-icon">payment</span>Riwayat Pembayaran</a></li>
        <li><a href="profil.html"><span class="material-symbols-outlined nav-icon">person</span>Profil Saya</a></li>
    </ul>
</nav>
            <div class="sidebar-footer">
                 <a href="../kontak.html"><span class="material-symbols-outlined nav-icon">help</span>Bantuan</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h1>Pesanan Saya</h1>
                <a href="../layanan.html" class="btn">Buat Pesanan Baru</a>
            </header>

            <section class="card">
                <h3>Daftar Semua Pesanan</h3>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Produk</th>
                            <th>Tanggal Pesan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PJ20251001</td>
                            <td>Wedding Premier Suit</td>
                            <td>01 Okt 2025</td>
                            <td>Rp 4.500.000</td>
                            <td><span class="order-status status-process">Fitting</span></td>
                        </tr>
                        <tr>
                            <td>#PJ20250915</td>
                            <td>Business Essential Suit</td>
                            <td>15 Sep 2025</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="order-status status-completed">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>#PJ20250820</td>
                            <td>Custom Casual Blazer</td>
                            <td>20 Agu 2025</td>
                            <td>Rp 1.800.000</td>
                             <td><span class="order-status status-sewing">Proses Jahit</span></td>
                        </tr>
                        <tr>
                            <td>#PJ20250705</td>
                            <td>Business Essential Suit</td>
                            <td>05 Jul 2025</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="order-status status-cancelled">Dibatalkan</span></td>
                        </tr>
                         <tr>
                            <td>#PJ20250610</td>
                            <td>Wedding Premier Suit</td>
                            <td>10 Jun 2025</td>
                            <td>Rp 4.000.000</td>
                            <td><span class="order-status status-completed">Selesai</span></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script src="../assets/js/dashboard.js"></script>
</body>
</html>