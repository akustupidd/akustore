<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureImage extends Model
{
    public $table = "feature_img";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
    protected $fillable = ['product_id', 'image_path'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
