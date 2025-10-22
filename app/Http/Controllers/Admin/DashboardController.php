<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $totalPesanan = Order::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        // Hitung pendapatan hanya dari pembayaran yang 'success'
        $totalPendapatan = Payment::where('status', 'success')->sum('jumlah');

        // Ambil 5 pesanan terbaru
        $pesananTerbaru = Order::with('user', 'product')
                            ->latest() // Urutkan dari yg terbaru
                            ->take(5)  // Ambil 5 saja
                            ->get();

        // Kirim data ke view
        return view('admin.dashboard.index', [
            'totalPesanan' => $totalPesanan,
            'totalPelanggan' => $totalPelanggan,
            'totalPendapatan' => $totalPendapatan,
            'pesananTerbaru' => $pesananTerbaru,
        ]);
    }
}