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

// app/Http/Controllers/Pelanggan/OrderController.php

    
    public function store(Request $request)
    {
        // 1. Validasi
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

        // 2. Gunakan DB Transaction closure untuk otomatis commit/rollback
        try {
            $order = DB::transaction(function () use ($validated, $product, $user) {
                // Buat entri Order dengan mass assignment
                $order = Order::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    // order_code menggunakan uniqid + time untuk mengurangi collision
                    'order_code' => 'MNS-' . strtoupper(uniqid((string) time())),
                    'total_harga' => $product->harga,
                    'status' => 'Menunggu Pembayaran',
                ]);

                // Simpan pengukuran terkait (hanya field yang ada di $validated)
                $order->measurement()->create($validated);

                // Buat entri Payment via mass assignment
                $order->payment()->create([
                    'jumlah' => $product->harga,
                    'status' => 'pending',
                ]);

                return $order;
            });

            // Arahkan ke halaman pembayaran
            return redirect()->route('pelanggan.payment.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan lanjutkan pembayaran.');

        } catch (\Exception $e) {
            // Log error untuk debugging (butuh use Illuminate\Support\Facades\Log jika ingin lebih)
            report($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage());
        }
    }
}