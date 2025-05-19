<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Admin extends Authenticatable
{
    use HasFactory;
    public $table = "admins";
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_number',
        'address',
        'role_id',
        'password',
        'image',
    ];
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'admin_id');
    }
    // You can define additional attributes or methods here if needed
}