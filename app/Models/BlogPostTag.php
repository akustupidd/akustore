<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostTag extends Model
{
    use HasFactory;

    protected $table = 'blog_post_tags';

    protected $fillable = ['blog_id', 'tag_id'];

    public $timestamps = false; // No need for timestamps in a pivot table
}