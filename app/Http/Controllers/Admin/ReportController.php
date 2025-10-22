<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <-- Import PDF

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan (HTML).
     */
    public function index()
    {
        // Ambil data pembayaran yang sukses
        $payments = Payment::where('status', 'success')
                            ->with('order.user', 'order.product')
                            ->latest()
                            ->get();

        $totalPendapatan = $payments->sum('jumlah');
        $pesananSelesai = $payments->count();

        return view('admin.reports.index', compact('payments', 'totalPendapatan', 'pesananSelesai'));
    }

    /**
     * Mengunduh laporan dalam format PDF.
     */
    public function downloadPDF()
    {
        // Ambil data yang sama
        $payments = Payment::where('status', 'success')
                            ->with('order.user', 'order.product')
                            ->latest()
                            ->get();
        $totalPendapatan = $payments->sum('jumlah');

        // Siapkan data untuk view
        $data = [
            'payments' => $payments,
            'totalPendapatan' => $totalPendapatan,
            'tanggalCetak' => date('d M Y')
        ];

        // Load view PDF dan data
        $pdf = Pdf::loadView('admin.reports.pdf', $data);

        // Download file
        return $pdf->download('laporan-penjualan-mensu-' . date('Y-m-d') . '.pdf');
    }
}