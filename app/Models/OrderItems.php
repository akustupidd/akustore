<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'product_id',
        'product_type',
        'user_id',
        'product_name',
        'quantity',
        'price',
        'total_price',
        'ram',
        'storage',
        'color',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
