<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan {{ $order->order_code }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style-pembayaran.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <div class="payment-container">
        <div class="payment-header">
            <h1>Selesaikan Pembayaran</h1>
        </div>

        <div class="order-summary">
            <div class="summary-header">Ringkasan Pesanan</div>
            <div class="summary-body">
                <div class="summary-item">
                    <span>Produk:</span>
                    <span>{{ $order->product->nama }}</span>
                </div>
                <div class="summary-item">
                    <span>Kode Pesanan:</span>
                    <span>{{ $order->order_code }}</span>
                </div>
                <div class="summary-item">
                    <span>Pelanggan:</span>
                    <span>{{ $order->user->fullname }}</span>
                </div>
                <div class="summary-item summary-total">
                    <span>Total:</span>
                    <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="payment-methods">
            <button id="pay-button" class="pay-btn">Bayar Sekarang</button>
        </div>
    </div>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Panggil snap.pay() dengan Snap Token dari controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    /* Pembayaran sukses! */
                    console.log(result);
                    alert('Pembayaran sukses!');
                    // Redirect ke halaman riwayat pesanan
                    window.location.href = '{{ route('pelanggan.orders.index') }}';
                },
                onPending: function(result){
                    /* Pembayaran pending */
                    console.log(result);
                    alert('Menunggu pembayaran Anda.');
                    window.location.href = '{{ route('pelanggan.orders.index') }}';
                },
                onError: function(result){
                    /* Error */
                    console.log(result);
                    alert('Pembayaran gagal.');
                },
                onClose: function(){
                    /* Pop-up ditutup tanpa bayar */
                    alert('Anda menutup pop-up pembayaran.');
                }
            });
        });
    </script>
</body>
</html>