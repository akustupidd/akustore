<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    public $table = "slide_banners";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
}
