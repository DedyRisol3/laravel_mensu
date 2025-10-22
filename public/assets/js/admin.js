document.addEventListener('DOMContentLoaded', () => {
    // --- AMBIL DATA DARI LOCALSTORAGE ---
    const users = JSON.parse(localStorage.getItem('users')) || [];
    let orders = JSON.parse(localStorage.getItem('orders')) || [];
    // (Data 'services' dan 'couriers' juga diinisialisasi di sini)
    if (!localStorage.getItem('services')) { /* ... kode inisialisasi ... */ }
    if (!localStorage.getItem('couriers')) { /* ... kode inisialisasi ... */ }
    let services = JSON.parse(localStorage.getItem('services'));
    
    // --- ROUTING BERDASARKAN HALAMAN AKTIF ---
    const currentPage = window.location.pathname;

    if (currentPage.includes('dashboard.html')) {
        renderDashboardData();
    } else if (currentPage.includes('data-pelanggan.html')) {
        renderCustomerData();
    } else if (currentPage.includes('data-pesanan.html')) {
        renderOrderData();
        addOrderEventListeners();
    } else if (currentPage.includes('manajemen-pembayaran.html')) {
        renderPaymentData();
        addPaymentEventListeners();
    } else if (currentPage.includes('manajemen-pengantaran.html')) {
        // --- LOGIKA BARU ---
        renderPengantaranData();
        addPengantaranEventListeners();
    } else if (currentPage.includes('manajemen-layanan.html')) {
        renderLayananData();
        addLayananEventListeners();
    } else if (currentPage.includes('laporan.html')) {
        renderReportData();
    }

    // --- (Fungsi-fungsi lain tetap sama) ---
    function formatRupiah(number) { /* ... kode sama ... */ }
    function renderDashboardData() { /* ... kode sama ... */ }
    function renderCustomerData() { /* ... kode sama ... */ }
    function renderOrderData() { /* ... kode sama ... */ }
    function addOrderEventListeners() { /* ... kode sama ... */ }
    function renderPaymentData() { /* ... kode sama ... */ }
    function addPaymentEventListeners() { /* ... kode sama ... */ }
    function renderLayananData() { /* ... kode sama ... */ }
    function addLayananEventListeners() { /* ... kode sama ... */ }
    function renderReportData() { /* ... kode sama ... */ }
    
    
    // --- FUNGSI BARU UNTUK MANAJEMEN PENGANTARAN ---

    /**
     * Merender tabel pesanan yang HANYA berstatus 'Selesai'.
     */
    function renderPengantaranData() {
        const pengantaranTableBody = document.getElementById('pengantaranTableBody');
        if (!pengantaranTableBody) return;

        // Filter pesanan
        const readyToShip = orders.filter(order => order.status === 'Selesai');
        
        if (readyToShip.length === 0) {
            pengantaranTableBody.innerHTML = `<tr><td colspan="5" style="text-align:center;">Tidak ada pesanan yang siap dikirim.</td></tr>`;
            return;
        }

        pengantaranTableBody.innerHTML = readyToShip.map(order => {
            // Ambil detail pelanggan (alamat & no.hp)
            const customer = users.find(u => u.fullname === order.customer);
            const alamat = customer ? customer.alamat : 'Alamat tidak ditemukan';
            const noHp = customer ? customer.noHp : '-';
            
            return `
                <tr>
                    <td>${order.id}</td>
                    <td>${order.customer}</td>
                    <td>${alamat}</td>
                    <td>${noHp}</td>
                    <td class="action-buttons">
                        <a href="#" class="btn-edit btn-ship-order" data-id="${order.id}">Kirim Sekarang</a>
                    </td>
                </tr>
            `;
        }).join('');
    }

    /**
     * Menambahkan listener untuk tombol 'Kirim Sekarang'.
     */
    function addPengantaranEventListeners() {
        const pengantaranTableBody = document.getElementById('pengantaranTableBody');
        if (!pengantaranTableBody) return;

        pengantaranTableBody.addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-ship-order')) {
                e.preventDefault();
                
                if (confirm('Tugaskan pesanan ini untuk pengiriman?')) {
                    const orderId = e.target.dataset.id;
                    const orderIndex = orders.findIndex(o => o.id === orderId);
                    
                    if (orderIndex !== -1) {
                        // Ubah status dari 'Selesai' -> 'Dalam Pengantaran'
                        orders[orderIndex].status = 'Dalam Pengantaran';
                        localStorage.setItem('orders', JSON.stringify(orders));
                        
                        // Render ulang tabel (pesanan akan hilang dari daftar ini)
                        renderPengantaranData();
                        alert('Pesanan telah ditugaskan ke kurir (Status: Dalam Pengantaran).');
                    }
                }
            }
        });
    }

});