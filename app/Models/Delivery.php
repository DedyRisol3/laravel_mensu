<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- REFAKTOR: Tambahkan ini
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory; // <-- REFAKTOR: Tambahkan ini

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'kurir_id', // ID user kurir
        'status',
        'alamat_tujuan',
    ];

    /**
     * Relasi: Pengantaran ini milik satu Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi: Pengantaran ini ditugaskan ke satu User (Kurir).
     * Kita beri nama 'kurir' agar jelas.
     */
    public function kurir()
    {
        // Parameter kedua ('kurir_id') penting karena nama foreign key berbeda dari default ('user_id')
        return $this->belongsTo(User::class, 'kurir_id');
    }
}