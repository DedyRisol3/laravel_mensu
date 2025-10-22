<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Satu produk bisa dipesan di banyak Order.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}