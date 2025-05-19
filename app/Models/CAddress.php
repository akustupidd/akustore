<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CAddress extends Model
{
    // Set the correct table name
    protected $table = 'c_address';  // Explicitly define the table name
     // Disable timestamps
    public $timestamps = false;


    // Define the fields that are mass assignable
    protected $fillable = [
        'customer_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
