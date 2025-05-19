<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_type',
        'image',
        'name',
        'quantity', // You'll manually handle quantity based on stock data
        'price', // Price will be set from the related stock model, not through mass-assignment
        'user_id',
        'color',
        'ram',
        'storage'
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Optionally, define a relationship to the stock if it's a separate model
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'product_id');
    }
}
