<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->string('order_code')->unique();
            $table->decimal('total_harga', 15, 2);
            // Status berdasarkan alur di .js Anda
            $table->string('status')->default('Menunggu Pembayaran');
            // Status: Menunggu Pembayaran, Proses Jahit, Fitting, Selesai, Dalam Pengantaran, Diterima Pelanggan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
