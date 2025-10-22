<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    /**
     * Menandai pengantaran sebagai selesai.
     */
    public function complete(Request $request, Delivery $delivery)
    {
        // Pastikan kurir yang benar yang menyelesaikan
        if ($delivery->kurir_id != Auth::id()) {
            return redirect()->back()->with('error', 'Ini bukan tugas Anda.');
        }

        // 1. Update status Delivery
        $delivery->status = 'Selesai';
        $delivery->save();

        // 2. Update status Order utama
        $delivery->order->update(['status' => 'Diterima Pelanggan']);

        return redirect()->route('kurir.dashboard')->with('success', 'Pengantaran telah diselesaikan.');
    }
    
    // ... (Method 'history' bisa Anda isi nanti)
    /**
     * Menampilkan riwayat pengantaran yang sudah selesai.
     */
    public function history()
    {
        $riwayat = Delivery::where('kurir_id', Auth::id())
        ->where('status', 'Selesai')
        ->with('order.user')
        ->latest()
        ->get();
        return view('kurir.delivery.history', compact('riwayat'));
    }
}