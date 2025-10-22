<?php
namespace App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil 3 pesanan terbaru untuk ringkasan
        $pesananTerbaru = $user->orders()
                              ->with('product')
                              ->latest()
                              ->take(3)
                              ->get();

        $totalPesanan = $user->orders()->count();

        return view('pelanggan.dashboard.index', [
            'pesananTerbaru' => $pesananTerbaru,
            'totalPesanan' => $totalPesanan
        ]);
    }
}