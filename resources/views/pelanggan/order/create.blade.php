{{-- Kita akan gunakan layout pelanggan (buat file ini dari pelanggan/dashboard.html) --}}
{{-- @extends('layouts.pelanggan') --}}
{{-- @section('content') --}}

{{-- Untuk saat ini, kita pakai file utuh dulu agar cepat --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Ukuran - {{ $product->nama }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style-ukuran.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="ukuran-container">
        <div class="ukuran-header">
            <h1>Masukkan Ukuran Jas Anda</h1>
            <p>Anda memesan: <strong>{{ $product->nama }}</strong> (Rp {{ number_format($product->harga) }})</p>
        </div>

        <form id="ukuranForm" method="POST" action="{{ route('pelanggan.order.store') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            <div class="ukuran-form-grid">
                <div class="input-group">
                    <label for="lingkar_badan">Lingkar Badan</label>
                    <div class="input-field">
                        <input type="number" name="lingkar_badan" required placeholder="Ukur keliling dada">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="lingkar_pinggang">Lingkar Pinggang</label>
                    <div class="input-field">
                        <input type="number" name="lingkar_pinggang" required placeholder="Ukur bagian terkecil">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="lingkar_pinggul">Lingkar Pinggul</label>
                    <div class="input-field">
                        <input type="number" name="lingkar_pinggul" required placeholder="Ukur bagian terbesar">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="lebar_bahu">Lebar Bahu</label>
                    <div class="input-field">
                        <input type="number" name="lebar_bahu" required placeholder="Ukur dari ujung ke ujung">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="panjang_baju">Panjang Baju</label>
                    <div class="input-field">
                        <input type="number" name="panjang_baju" required placeholder="Dari bahu ke bawah">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="panjang_lengan">Panjang Lengan</label>
                    <div class="input-field">
                        <input type="number" name="panjang_lengan" required placeholder="Dari bahu ke pergelangan">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="tinggi_punggung">Tinggi Punggung</label>
                    <div class="input-field">
                        <input type="number" name="tinggi_punggung" required placeholder="Dari tengkuk ke pinggang">
                        <span>Cm</span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="lingkar_leher">Lingkar Leher</label>
                    <div class="input-field">
                        <input type="number" name="lingkar_leher" required placeholder="Ukur keliling pangkal leher">
                        <span>Cm</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Ukuran & Lanjut</button>
            </div>
        </form>
    </div>
</body>
</html>
{{-- @endsection --}}