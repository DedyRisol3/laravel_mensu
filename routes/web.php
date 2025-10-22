<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller kita
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;

// Pelanggan Controllers
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\OrderController as PelangganOrderController;

// Kurir Controllers
use App\Http\Controllers\Kurir\DashboardController as KurirDashboardController;
use App\Http\Controllers\Kurir\DeliveryController as KurirDeliveryController;


/*
|--------------------------------------------------------------------------
| Rute Publik (Guest)
|--------------------------------------------------------------------------
| Rute-rute ini bisa diakses siapa saja (termasuk dari index.html, tentang.html, dll)
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/pengantaran', [HomeController::class, 'pengantaran'])->name('pengantaran');

// Rute untuk halaman 'layanan.html' publik
Route::get('/layanan', [ProductController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{product}', [ProductController::class, 'show'])->name('layanan.show');


/*
|--------------------------------------------------------------------------
| Rute Autentikasi
|--------------------------------------------------------------------------
| Rute untuk login, register, dan redirect dashboard utama
*/
require __DIR__.'/auth.php';

// Rute /dashboard utama yang akan me-redirect berdasarkan role (dari Tahap 2)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute Profil (Breeze) - bisa diakses semua role
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Rute Grup PELANGGAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    
    Route::get('/dashboard', [PelangganDashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk alur 'pelanggan/pesanan.html'
    Route::get('/pesanan', [PelangganOrderController::class, 'index'])->name('orders.index');
    
    // Rute untuk alur 'pelanggan/ukuran.html'
    Route::get('/pesan/layanan/{product}', [PelangganOrderController::class, 'create'])->name('order.create');
    Route::post('/pesan', [PelangganOrderController::class, 'store'])->name('order.store');
    
    // Rute untuk 'pelanggan/pembayaran.html' (Midtrans nanti di sini)
    Route::get('/payment/{order}', [\App\Http\Controllers\Pelanggan\PaymentController::class, 'show'])->name('payment.show');
});


/*
|--------------------------------------------------------------------------
| Rute Grup ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk 'admin/manajemen-layanan.html' (CRUD)
    // Ini otomatis membuat 7 rute (index, create, store, show, edit, update, destroy)
    Route::resource('/products', AdminProductController::class);

    // Rute untuk 'admin/data-pesanan.html'
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Rute untuk 'admin/data-pelanggan.html'
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');

    // Rute untuk 'admin/manajemen-pengantaran.html'
    // ...

    // Rute untuk Laporan
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download-pdf', [\App\Http\Controllers\Admin\ReportController::class, 'downloadPDF'])->name('reports.downloadPDF');
});


/*
|--------------------------------------------------------------------------
| Rute Grup KURIR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    
    // Rute untuk 'kurir/dashboard.html'
    Route::get('/dashboard', [KurirDashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk 'kurir/riwayat.html'
    Route::get('/deliveries/history', [KurirDeliveryController::class, 'history'])->name('deliveries.history');
    
    // Rute untuk update status pengantaran
    Route::patch('/deliveries/{delivery}/complete', [KurirDeliveryController::class, 'complete'])->name('deliveries.complete');
});

// RUTE WEBHOOK MIDTRANS
Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransCallbackController::class, 'handle'])->name('midtrans.callback');