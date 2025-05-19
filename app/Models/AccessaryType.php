<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessaryType extends Model
{
    public $table = "accessaries_type";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;

    use HasFactory;
    protected $fillable = ['name'];
}
