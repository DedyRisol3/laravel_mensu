<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMeasurement;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Kita akan gunakan DB Transaction

class OrderController extends Controller
{

    public function index()
    {
        $semuaPesanan = Auth::user()->orders()
        ->with('product')
        ->latest()
        ->get();
        return view('pelanggan.order.index', compact('semuaPesanan'));
    }
    /**
     * Menampilkan form input ukuran (langkah 1 pemesanan).
     */

    public function create(Product $product)
    {
        // $product didapat otomatis dari rute model binding
        return view('pelanggan.order.create', compact('product'));
    }

    /**
     * Menyimpan data pesanan dan ukuran (langkah 2 pemesanan).
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form ukuran
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'lingkar_badan' => 'required|numeric',
            'lingkar_pinggang' => 'required|numeric',
            'lingkar_pinggul' => 'required|numeric',
            'lebar_bahu' => 'required|numeric',
            'panjang_baju' => 'required|numeric',
            'panjang_lengan' => 'required|numeric',
            'tinggi_punggung' => 'required|numeric',
            'lingkar_leher' => 'required|numeric',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $user = Auth::user();
        
        // 2. Gunakan DB Transaction untuk memastikan semua data tersimpan
        try {
            DB::beginTransaction();

            // 3. Buat entri Order
            $order = new Order();
            $order->user_id = $user->id;
            $order->product_id = $product->id;
            $order->order_code = 'MNS-' . strtoupper(uniqid()); // Buat Order Code unik
            $order->total_harga = $product->harga;
            $order->status = 'Menunggu Pembayaran'; // Status Awal
            $order->save();

            // 4. Buat entri OrderMeasurement
            $measurement = new OrderMeasurement();
            $measurement->order_id = $order->id;
            $measurement->fill($validated); // Isi semua data ukuran
            $measurement->save();

            // 5. Buat entri Payment (untuk Midtrans nanti)
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->jumlah = $product->harga;
            $payment->status = 'pending';
            $payment->save();

            DB::commit(); // Simpan semua data jika berhasil

            // 6. Arahkan ke halaman pembayaran (Tahap 7)
            // Untuk saat ini, kita arahkan ke dasbor pelanggan
            return redirect()->route('pelanggan.payment.show', $order->id)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lanjutkan pembayaran.');
        } catch (\Exception $e) {            
            // return redirect()->route('pelanggan.payment.show', $order->id);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage());
        }
    }
}