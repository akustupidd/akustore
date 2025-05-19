<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'contact',
        'country',
        'fname',
        'lname',
        'address',
        'apartment',
        'city',
        'postal_code',
        'shipping',
        'payment',
        'status',
        'message',
        'total',
        'tracking_no',
    ];
}
