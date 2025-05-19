<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $table = "brands";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;

    // protected static function boot()
    //     {
    //         parent::boot();

    //         static::creating(function ($brand) {
    //             $brand->slug = Str::slug($brand->name);
    //         });

    //         static::updating(function ($brand) {
    //             $brand->slug = Str::slug($brand->name);
    //         });
    //     }
}
