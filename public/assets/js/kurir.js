document.addEventListener('DOMContentLoaded', () => {
    const currentPage = window.location.pathname;

    // --- LOGIKA LOGIN KURIR ---
    if (currentPage.includes('login.html')) {
        handleLoginPage();
    } else {
        // --- LOGIKA SEMUA HALAMAN TERPROTEKSI (DASBOR, RIWAYAT, DLL.) ---
        handleProtectedPages(currentPage);
    }
});

/**
 * Menangani logika di halaman login
 */
function handleLoginPage() {
    // Jika sudah login, tendang ke dasbor
    if (localStorage.getItem('loggedInCourier')) {
        window.location.href = 'dashboard.html';
    }

    const loginForm = document.getElementById('kurirLoginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const couriers = JSON.parse(localStorage.getItem('couriers')) || [];
            const courier = couriers.find(c => c.email === email && c.password === password);

            if (courier) {
                localStorage.setItem('loggedInCourier', JSON.stringify(courier));
                alert('Login kurir berhasil!');
                window.location.href = 'dashboard.html';
            } else {
                alert('Email atau password kurir salah.');
            }
        });
    }
}

/**
 * Menangani logika untuk semua halaman yang memerlukan login kurir
 */
function handleProtectedPages(currentPage) {
    const loggedInCourier = JSON.parse(localStorage.getItem('loggedInCourier'));

    // 1. Lindungi Halaman
    if (!loggedInCourier) {
        alert('Anda harus login sebagai kurir.');
        window.location.href = 'login.html';
        return;
    }

    // 2. Setup Sapaan & Tombol Logout
    const courierNameEl = document.getElementById('courierName');
    const welcomeNameEl = document.getElementById('welcomeCourierName');
    const logoutBtn = document.getElementById('logoutBtn');

    if(courierNameEl) courierNameEl.textContent = loggedInCourier.fullname;
    if(welcomeNameEl) welcomeNameEl.textContent = `Selamat Datang, ${loggedInCourier.fullname}!`;

    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            localStorage.removeItem('loggedInCourier');
            alert('Anda telah keluar.');
            window.location.href = 'login.html';
        });
    }

    // 3. Routing Halaman
    if (currentPage.includes('dashboard.html')) {
        renderDeliveryData();
    } else if (currentPage.includes('riwayat.html')) {
        renderHistoryData();
    }
}

/**
 * Merender data pengantaran AKTIF di dasbor
 */
function renderDeliveryData() {
    const deliveryTableBody = document.getElementById('deliveryTableBody');
    if (!deliveryTableBody) return;

    const allOrders = JSON.parse(localStorage.getItem('orders')) || [];
    const allUsers = JSON.parse(localStorage.getItem('users')) || [];

    // Hanya ambil pesanan yang statusnya 'Dalam Pengantaran'
    const ordersToDeliver = allOrders.filter(o => o.status === 'Dalam Pengantaran');

    if (ordersToDeliver.length === 0) {
        deliveryTableBody.innerHTML = `<tr><td colspan="5" style="text-align:center;">Tidak ada tugas pengantaran saat ini.</td></tr>`;
        return;
    }

    deliveryTableBody.innerHTML = ordersToDeliver.map(order => {
        const customer = allUsers.find(u => u.fullname === order.customer);
        const alamat = customer ? customer.alamat : 'Alamat tidak ditemukan';
        const noHp = customer ? customer.noHp : '-';
        
        return `
            <tr>
                <td>${order.id}</td>
                <td>${order.customer}</td>
                <td>${alamat}</td>
                <td>${noHp}</td>
                <td class="action-buttons">
                    <a href="#" class="btn-update-delivery" data-id="${order.id}">Selesai Antar</a>
                </td>
            </tr>
        `;
    }).join('');

    // Tambahkan listener untuk tombol 'Selesai Antar'
    deliveryTableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-update-delivery')) {
            e.preventDefault();
            const orderId = e.target.dataset.id;
            updateDeliveryStatus(orderId);
        }
    });
}

/**
 * Fungsi untuk update status pengantaran
 */
function updateDeliveryStatus(orderId) {
    if (confirm('Konfirmasi bahwa pesanan ini telah diterima oleh pelanggan?')) {
        let allOrders = JSON.parse(localStorage.getItem('orders'));
        const orderIndex = allOrders.findIndex(o => o.id === orderId);

        if (orderIndex !== -1) {
            allOrders[orderIndex].status = 'Diterima Pelanggan';
            localStorage.setItem('orders', JSON.stringify(allOrders));
            
            alert(`Status pesanan ${orderId} diubah menjadi "Diterima Pelanggan"`);
            renderDeliveryData(); // Render ulang tabel dasbor (pesanan akan hilang)
        }
    }
}

/**
 * FUNGSI BARU: Merender data riwayat pengantaran
 */
function renderHistoryData() {
    const historyTableBody = document.getElementById('historyTableBody');
    if (!historyTableBody) return;

    const allOrders = JSON.parse(localStorage.getItem('orders')) || [];
    const allUsers = JSON.parse(localStorage.getItem('users')) || [];

    // Hanya ambil pesanan yang statusnya 'Diterima Pelanggan'
    const deliveredOrders = allOrders.filter(o => o.status === 'Diterima Pelanggan');

    if (deliveredOrders.length === 0) {
        historyTableBody.innerHTML = `<tr><td colspan="4" style="text-align:center;">Belum ada riwayat pengantaran.</td></tr>`;
        return;
    }

    historyTableBody.innerHTML = deliveredOrders.map(order => {
        const customer = allUsers.find(u => u.fullname === order.customer);
        const alamat = customer ? customer.alamat : 'Alamat tidak ditemukan';
        
        return `
            <tr>
                <td>${order.id}</td>
                <td>${order.customer}</td>
                <td>${alamat}</td>
                <td><span style="color: green; font-weight: bold;">${order.status}</span></td>
            </tr>
        `;
    }).join('');
}