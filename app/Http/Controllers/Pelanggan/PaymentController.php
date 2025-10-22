<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran dan mendapatkan Snap Token.
     */
    public function show(Order $order)
    {
        // Pastikan pesanan ini milik user yang sedang login
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Ambil data payment dari order
        $payment = $order->payment;

        // Buat parameter untuk Midtrans Snap
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code, // Gunakan order_code unik
                'gross_amount' => $order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $order->user->fullname,
                'email' => $order->user->email,
                'phone' => $order->user->no_hp,
                'billing_address' => [
                    'address' => $order->user->alamat,
                ]
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan token ke database (opsional tapi bagus)
        $payment->update(['midtrans_token' => $snapToken]);

        // Tampilkan view dengan snapToken
        return view('pelanggan.payment.show', compact('order', 'snapToken'));
    }
}