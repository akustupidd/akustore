<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogMedia extends Model
{
    use HasFactory;

    protected $table = 'blog_media';

    protected $fillable = ['blog_id', 'media_type', 'media_url'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
