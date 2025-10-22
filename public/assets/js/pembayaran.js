document.addEventListener('DOMContentLoaded', () => {
    // Lindungi halaman
    const loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));
    if (!loggedInUser) {
        window.location.href = '../login.html';
        return;
    }

    // Ambil ID pesanan dari parameter URL
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId');

    if (!orderId) {
        alert('ID Pesanan tidak ditemukan.');
        window.location.href = 'dashboard.html';
        return;
    }

    // Cari pesanan di localStorage
    const orders = JSON.parse(localStorage.getItem('orders')) || [];
    const orderToPay = orders.find(order => order.id === orderId);

    if (!orderToPay) {
        alert('Pesanan tidak ditemukan.');
        window.location.href = 'dashboard.html';
        return;
    }

    // Tampilkan detail pesanan di halaman
    document.getElementById('orderIdDisplay').textContent = orderToPay.id;
    document.getElementById('orderDateDisplay').textContent = orderToPay.date;
    const formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(orderToPay.total);
    document.getElementById('orderTotalDisplay').textContent = formattedTotal;

    // Tambahkan event listener untuk tombol bayar
    const payButton = document.getElementById('payButton');
    payButton.addEventListener('click', () => {
        // Simulasi proses pembayaran
        payButton.textContent = 'Memproses...';
        payButton.disabled = true;

        setTimeout(() => {
            // Ubah status pesanan menjadi 'Proses Jahit'
            const orderIndex = orders.findIndex(order => order.id === orderId);
            if (orderIndex !== -1) {
                orders[orderIndex].status = 'Proses Jahit';
                localStorage.setItem('orders', JSON.stringify(orders));
            }

            alert('Pembayaran berhasil! Pesanan Anda sedang diproses.');
            window.location.href = 'pesanan.html';
        }, 2000); // Delay 2 detik untuk simulasi
    });
});