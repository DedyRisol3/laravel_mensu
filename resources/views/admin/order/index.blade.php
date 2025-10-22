@extends('layouts.admin')

@section('title', 'Manajemen Data Pesanan')

@section('content')
    <header class="content-header">
        <h1>Manajemen Data Pesanan</h1>
        <p>Total Pesanan Tercatat: <strong>{{ $orders->count() }}</strong></p>
    </header>
    
    <div class="card">
        <h3>Semua Pesanan</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->user->fullname }}</td>
                    <td>{{ $order->product->nama }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="status" class="status-select" onchange="this.form.submit()">
                                <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="Proses Jahit" {{ $order->status == 'Proses Jahit' ? 'selected' : '' }}>Proses Jahit</option>
                                <option value="Fitting" {{ $order->status == 'Fitting' ? 'selected' : '' }}>Fitting</option>
                                <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai (Siap Kirim)</option>
                                <option value="Dalam Pengantaran" {{ $order->status == 'Dalam Pengantaran' ? 'selected' : '' }}>Dalam Pengantaran</option>
                                <option value="Diterima Pelanggan" {{ $order->status == 'Diterima Pelanggan' ? 'selected' : '' }}>Diterima Pelanggan</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="#" class="btn-edit">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection