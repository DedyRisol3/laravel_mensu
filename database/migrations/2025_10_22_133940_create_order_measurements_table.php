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
        Schema::create('order_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('lingkar_badan');
            $table->string('lingkar_pinggang');
            $table->string('lingkar_pinggul');
            $table->string('lebar_bahu');
            $table->string('panjang_baju');
            $table->string('panjang_lengan');
            $table->string('tinggi_punggung');
            $table->string('lingkar_leher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_measurements');
    }
};
