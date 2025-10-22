document.addEventListener('DOMContentLoaded', () => {
    // Lindungi halaman, pastikan hanya user yang login bisa akses
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    if (!loggedInUser) {
        alert('Anda harus masuk terlebih dahulu untuk mengisi ukuran.');
        window.location.href = '../login.html';
        return;
    }

    const ukuranForm = document.getElementById('ukuranForm');
    ukuranForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const ukuran = {
            lingkarBadan: document.getElementById('lingkarBadan').value,
            lingkarPinggang: document.getElementById('lingkarPinggang').value,
            lingkarPinggul: document.getElementById('lingkarPinggul').value,
            lebarBahu: document.getElementById('lebarBahu').value,
            panjangBaju: document.getElementById('panjangBaju').value,
            panjangLengan: document.getElementById('panjangLengan').value,
            tinggiPunggung: document.getElementById('tinggiPunggung').value,
            lingkarLeher: document.getElementById('lingkarLeher').value,
        };
        localStorage.setItem('userUkuran', JSON.stringify(ukuran));

        // (Simulasi) Tambahkan pesanan baru dengan status "Menunggu Pembayaran"
        const orders = JSON.parse(localStorage.getItem('orders')) || [];
        const newOrderId = `#PJ${Date.now().toString().slice(-8)}`; // Buat ID unik
        const newOrder = {
            id: newOrderId,
            customer: loggedInUser.fullname,
            date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }),
            total: 2500000, // Harga contoh
            status: 'Menunggu Pembayaran' // Status baru
        };
        orders.unshift(newOrder);
        localStorage.setItem('orders', JSON.stringify(orders));

        // Arahkan ke halaman pembayaran dengan menyertakan ID pesanan
        alert('Ukuran Anda telah berhasil disimpan. Lanjutkan ke pembayaran.');
        window.location.href = `pembayaran-detail.html?orderId=${encodeURIComponent(newOrderId)}`;
    });
});