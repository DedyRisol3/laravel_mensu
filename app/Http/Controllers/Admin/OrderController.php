<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Delivery; // <-- Import Delivery
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Auth

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Ambil semua pesanan, muat relasi user dan product
        $orders = Order::with('user', 'product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);
        $newStatus = $request->status;

        // *** INI LOGIKA PENTING PENGANTARAN ***
        // Jika status diubah menjadi "Selesai" oleh Admin...
        if ($newStatus == 'Selesai' && $order->status != 'Selesai') {
            
            // Buat entri pengantaran baru untuk kurir
            Delivery::create([
                'order_id' => $order->id,
                'status' => 'Mencari Kurir', // Status awal untuk kurir
                'alamat_tujuan' => $order->user->alamat, // Ambil alamat dari pelanggan
            ]);
            
            // Anda juga bisa update status order menjadi "Dalam Pengantaran"
            // $order->status = "Dalam Pengantaran";
            // $order->save();
            // ...tapi kita biarkan Admin yang memilih status "Dalam Pengantaran"
        }
        
        // Jika status diubah ke 'Dalam Pengantaran', tugaskan ke kurir
        if ($newStatus == 'Dalam Pengantaran' && $order->status != 'Dalam Pengantaran') {
            // Cek apakah sudah ada delivery, jika tidak, buat
            $delivery = $order->delivery()->firstOrCreate(
                ['order_id' => $order->id],
                ['alamat_tujuan' => $order->user->alamat, 'status' => 'Mencari Kurir']
            );
            
            // Tugaskan ke kurir (untuk demo, kita tugaskan ke kurir pertama)
            // Nanti ini bisa jadi sistem lelang atau penugasan manual
            $kurir = \App\Models\User::where('role', 'kurir')->first();
            if ($kurir && $delivery->status == 'Mencari Kurir') {
                $delivery->kurir_id = $kurir->id;
                $delivery->status = 'Diantar';
                $delivery->save();
            }
        }

        // Update status order utama
        $order->update(['status' => $newStatus]);

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan diperbarui.');
    }
}