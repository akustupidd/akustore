<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $table = "colors";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
