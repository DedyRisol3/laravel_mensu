// Menunggu hingga seluruh konten halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. LOGIKA HEADER & LOGOUT ---
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    const headerActions = document.getElementById('header-actions');
    const currentPage = window.location.pathname;

    if (loggedInUser && headerActions) {
        // Jika ada pengguna yang login, ubah tampilan header
        headerActions.innerHTML = `
            <span class="welcome-user">Halo, ${loggedInUser.fullname}</span>
            <a href="#" id="logoutBtn" class="btn btn-primary">Keluar</a>
        `;

        // Tambahkan fungsionalitas untuk tombol logout
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', (e) => {
                e.preventDefault();
                localStorage.removeItem('loggedInUser');
                alert('Anda telah keluar.');
                
                // Cek apakah kita di dalam folder /pelanggan/
                if (currentPage.includes('/pelanggan/')) {
                    window.location.href = '../index.html'; // Kembali ke root
                } else {
                    window.location.reload(); // Muat ulang halaman
                }
            });
        }
    }

    // --- 2. LOGIKA BARU: RENDER HALAMAN LAYANAN SECARA DINAMIS ---
    if (currentPage.includes('layanan.html')) {
        renderLayananPage();
    }
});


/**
 * Fungsi baru untuk mengambil data layanan dari localStorage 
 * dan menampilkannya di halaman layanan.
 */
function renderLayananPage() {
    const container = document.getElementById('services-grid-container');
    if (!container) return; // Keluar jika kontainer tidak ditemukan

    const services = JSON.parse(localStorage.getItem('services')) || [];

    if (services.length === 0) {
        container.innerHTML = "<p>Saat ini belum ada layanan yang tersedia.</p>";
        return;
    }

    // Fungsi helper untuk format Rupiah
    const formatRupiah = (number) => {
         return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    // Buat HTML untuk setiap kartu layanan
    container.innerHTML = services.map(service => {
        // Ubah string "Fitur 1|Fitur 2" menjadi <li>Fitur 1</li><li>Fitur 2</li>
        const featuresHtml = service.features.split('|').map(feature => 
            `<li><span class="material-symbols-outlined">check</span>${feature}</li>`
        ).join('');

        return `
            <div class="service-card">
                <div class="service-card-image">
                    <img src="${service.img}" alt="${service.name}"> 
                </div>
                <div class="service-card-content">
                    <h3 class="service-title">${service.name}</h3>
                    <p class="service-description">${service.description}</p>
                    <ul class="service-features">
                        ${featuresHtml}
                    </ul>
                    <div class="service-price">${formatRupiah(service.price)}</div>
                    <a href="pelanggan/ukuran.html?serviceId=${service.id}" class="btn btn-secondary">Pesan & Isi Ukuran</a>
                </div>
            </div>
        `;
    }).join('');
}