<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftInfo extends Model
{
    public $table = "softinfo";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
}
