<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;

    public $table = "rams";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
    protected $fillable = ['size'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
