@extends('layouts.admin')

@section('title', 'Admin Dasbor')

@section('content')
<header class="content-header">
    <h1>Admin Dasbor</h1>
    <p>Selamat datang! Berikut adalah ringkasan aktivitas bisnis Anda.</p>
</header>

<section class="stat-cards-grid">
    <div class="stat-card">
        <div class="icon-container bg-blue">
            <span class="material-symbols-outlined">receipt_long</span>
        </div>
        <div class="info">
            <h4 id="totalPesanan">{{ $totalPesanan }}</h4>
            <p>Total Pesanan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="icon-container bg-green">
            <span class="material-symbols-outlined">group</span>
        </div>
        <div class="info">
            <h4 id="totalPelanggan">{{ $totalPelanggan }}</h4>
            <p>Total Pelanggan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="icon-container bg-gold">
            <span class="material-symbols-outlined">payments</span>
        </div>
        <div class="info">
            <h4 id="pendapatanBulanIni">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
            <p>Total Pendapatan</p>
        </div>
    </div>
</section>

<div class="card" style="margin-top: 30px;">
    <h3>Pesanan Terbaru</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="pesananTerbaruBody">
            @forelse($pesananTerbaru as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->user->fullname }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection