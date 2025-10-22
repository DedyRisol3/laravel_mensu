<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Penjualan - MenSu</h1>
    <p>Tanggal Cetak: {{ $tanggalCetak }}</p>
    <hr>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->order->order_code }}</td>
                <td>{{ $payment->order->user->fullname }}</td>
                <td>{{ $payment->order->product->nama }}</td>
                <td>{{ $payment->updated_at->format('d M Y') }}</td>
                <td>Rp {{ number_format($payment->jumlah) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;">Total Pendapatan:</th>
                <th>Rp {{ number_format($totalPendapatan) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>