<?php
namespace App;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'jumlah',
        'status',
        'metode_pembayaran',
        'midtrans_token',
        'midtrans_response',
    ];
    
}