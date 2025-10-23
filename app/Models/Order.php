<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Allow mass assignment for these fields so controllers can use create()/update().
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'order_code',
        'total_harga',
        'status',
    ];

    /**
     * Pesanan ini milik satu User (Pelanggan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Pesanan ini memesan satu Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Pesanan ini memiliki satu data Pengukuran.
     */
    public function measurement()
    {
        return $this->hasOne(OrderMeasurement::class);
    }

    /**
     * Pesanan ini memiliki satu data Pembayaran.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Pesanan ini memiliki satu data Pengantaran.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
}