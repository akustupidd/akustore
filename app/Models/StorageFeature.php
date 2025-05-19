<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageFeature extends Model
{
    use HasFactory;
    public $table = "storages_feature";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
