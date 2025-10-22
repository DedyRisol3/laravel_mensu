<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        // Buat instance notifikasi Midtrans
        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderCode = $notif->order_id;
        $fraud = $notif->fraud_status;

        // Cari order berdasarkan order_code
        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        $payment = $order->payment;

        // Cek status transaksi
        if ($transaction == 'capture' || $transaction == 'settlement') {
            // Jika transaksi berhasil
            if ($fraud == 'accept') {
                // 1. Update status Payment
                $payment->update([
                    'status' => 'success',
                    'metode_pembayaran' => $type,
                    'midtrans_response' => $request->getContent()
                ]);
                // 2. Update status Order
                $order->update(['status' => 'Proses Jahit']);
            }
        } else if ($transaction == 'pending') {
            // Jika pembayaran pending
            $payment->update([
                'status' => 'pending',
                'metode_pembayaran' => $type,
                'midtrans_response' => $request->getContent()
            ]);
        } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            // Jika transaksi gagal
            $payment->update([
                'status' => 'failed',
                'midtrans_response' => $request->getContent()
            ]);
            $order->update(['status' => 'Dibatalkan']);
        }

        return response()->json(['message' => 'Notification processed.']);
    }
}