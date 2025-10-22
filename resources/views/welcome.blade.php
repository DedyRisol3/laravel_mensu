@extends('layouts.guest')

@section('title', 'Selamat Datang di MenSu')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Karya Seni Jas Pria, Dibuat Khusus Untuk Anda</h1>
            <p class="hero-subtitle">Setiap setelan adalah cerminan kepribadian. Kami menggabungkan presisi, bahan berkualitas, dan sentuhan personal untuk menciptakan jas yang sempurna.</p>
            <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Pesan Sekarang</a>
        </div>
        <div class="hero-image">
            </div>
    </section>

    <section class="features-section">
        <h2 class="section-title">Mengapa Memilih Kami?</h2>
        </section>

    <section class="process-section">
         <h2 class="section-title">Proses Pemesanan Mudah</h2>
         </section>
@endsection