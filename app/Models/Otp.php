<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    // Add fields that are mass assignable
    protected $fillable = ['email', 'otp', 'expires_at'];
}

