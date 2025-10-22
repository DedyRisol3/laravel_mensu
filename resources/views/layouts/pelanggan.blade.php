<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Pelanggan - Mensu</title>
    <link rel="stylesheet" href="../assets/css/style-dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                <h1 id="welcomeUserName">Selamat Datang!</h1>
                <div class="user-profile">
                    <span id="userName">Nama Pengguna</span>
                    <a href="#" id="logoutBtn">
                        <span class="material-symbols-outlined">logout</span>Keluar
                    </a>
                </div>
            </header>

            <section class="dashboard-grid">
                <div class="card">
                    <h3>Total Pesanan</h3>
                    <p style="font-size: 2em; font-weight: bold;">3</p>
                    <small>1 Pesanan dalam proses.</small>
                </div>
                <div class="card">
                    <h3>Status Akun</h3>
                    <p style="font-size: 2em; font-weight: bold; color: #28c76f;">Aktif</p>
                    <small>Pelanggan sejak: 15 Okt 2025</small>
                </div>
                <div class="card">
                    <h3>Butuh Bantuan?</h3>
                    <p>Tim kami siap membantu Anda.</p>
                    <a href="../kontak.html" class="btn btn-primary" style="background-color:#c0a062; border-color:#c0a062; color:white;">Hubungi Kami</a>
                </div>
            </section>
            
            <section class="card" style="margin-top: 25px;">
                <h3>Pesanan Terbaru</h3>
                <div class="order-list">
                    <div class="order-item">
                        <div>
                            <strong>Wedding Premier Suit</strong><br>
                            <small>ID Pesanan: #PJ20251001</small>
                        </div>
                        <span class="order-status status-process">Fitting</span>
                    </div>
                    <div class="order-item">
                         <div>
                            <strong>Business Essential Suit</strong><br>
                            <small>ID Pesanan: #PJ20250915</small>
                        </div>
                        <span class="order-status status-completed">Selesai</span>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script src="../assets/js/dashboard.js"></script>
</body>
</html>