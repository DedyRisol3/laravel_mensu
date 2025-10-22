@extends('layouts.admin')

@section('title', 'Manajemen Produk & Layanan')

@section('content')
    <header class="content-header">
        <h1>Manajemen Produk & Layanan</h1>
        <p>Tambah, edit, atau hapus layanan penjahitan yang Anda tawarkan.</p>
    </header>
    
    <div class="card">
        <h3 id="formLayananTitle">Tambah Layanan Baru</h3>
        <form id="formLayanan" class="form-grid" method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            
            <input type="hidden" id="serviceId">
            <div class="input-group">
                <label for="serviceName">Nama Layanan</label>
                <input type="text" id="serviceName" name="nama" required>
            </div>
            <div class="input-group">
                <label for="servicePrice">Harga</label>
                <input type="number" id="servicePrice" name="harga" required>
            </div>
            <div class="input-group full-width">
                <label for="serviceDesc">Deskripsi Singkat</label>
                <textarea id="serviceDesc" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="input-group full-width">
                <label for="serviceFeatures">Fitur Utama (pisahkan dengan | )</label>
                <input type="text" id="serviceFeatures" name="fitur" placeholder="Fitur 1|Fitur 2|Fitur 3" required>
            </div>
            <div class="input-group full-width">
                <label for="serviceImg">URL Gambar</label>
                <input type="text" id="serviceImg" name="gambar_url" placeholder="https://..." required>
            </div>
            <div class="form-actions full-width">
                <button type="submit" class="btn-save">Simpan Layanan</button>
            </div>
        </form>
    </div>

    <div class="card" style="margin-top: 30px;">
        <h3>Daftar Layanan Saat Ini</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="layananTableBody">
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->nama }}</td>
                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="action-buttons">
                            <a href="#" class="btn-edit">Edit</a>
                            <a href="#" class="btn-delete">Hapus</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection