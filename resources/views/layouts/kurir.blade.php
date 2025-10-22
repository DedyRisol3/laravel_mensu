<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Kurir - Mensu</title>
    <link rel="stylesheet" href="../assets/css/style-kurir.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="kurir-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Dasbor Kurir</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.html" class="active"><span class="material-symbols-outlined nav-icon">local_shipping</span>Pengantaran Hari Ini</a></li>
                    <li><a href="riwayat.html"><span class="material-symbols-outlined nav-icon">history</span>Riwayat Pengantaran</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h1 id="welcomeCourierName">Selamat Datang!</h1>
                <div class="user-profile">
                    <span id="courierName">Nama Kurir</span>
                    <a href="#" id="logoutBtn">Keluar</a>
                </div>
            </header>

            <div class="card">
                <h3>Daftar Pesanan Siap Antar</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="deliveryTableBody">
                        </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="../assets/js/kurir.js"></script>
</body>
</html>