<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public $table = "specifications";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
}
