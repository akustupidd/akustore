<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    protected $fillable = [
        'image',
        'name',
        'price',
        'quantity',
        'type',
        'category_id',
        'brand_id',
        'accessary_id',
        'stock_id',
        'slug'

    ];

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

    public function rams()
    {
        return $this->belongsToMany(Ram::class, 'rams_feature');
    }

    public function storages()
    {
        return $this->belongsToMany(Storage::class, 'storages_feature');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'colors_feature');
    }
}

