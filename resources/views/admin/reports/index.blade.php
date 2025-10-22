{{-- di dalam resources/views/admin/reports/index.blade.php --}}
<header class="content-header">
    <h1>Laporan & Analitik</h1>
    <a href="{{ route('admin.reports.downloadPDF') }}" class="btn-save" style="text-decoration: none;">Download PDF</a>
</header>

<section class="report-summary-grid">
    <div class="summary-card">
        <p>Total Pendapatan (Selesai)</p>
        <h3 id="totalPendapatan">Rp {{ number_format($totalPendapatan) }}</h3>
    </div>
    <div class="summary-card">
        <p>Total Pesanan Selesai</p>
        <h3 id="pesananSelesai">{{ $pesananSelesai }}</h3>
    </div>
</section>

{{-- (Tabel transaksi di bawahnya) --}}