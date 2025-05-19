<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    public $table = "customers";
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamp = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email','password', 'phone_number', 'address', 'dob',
        'last_active', 'last_device', 'last_browser', 'last_ip',
        'last_location', 'is_active', 'latitude', 'longitude', 'image', 'gender', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
