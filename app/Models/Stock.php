<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $table = "stock";
    protected $fillable = [
        'product_id', 
        'item_name', 
        'quantity',
        'price',
        'sku',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
