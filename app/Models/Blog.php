<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'blog_category_id',
        'content',
        'admin_id',
        'media_type',
        'status',
        'published_at',
        'cover_image',
        'video_url',
        'created_at',
        'update_at',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tags', 'blog_id', 'tag_id');
    }

    public function media()
    {
        return $this->hasMany(BlogMedia::class, 'blog_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_post_id');
    }
    public function blogCategory() {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id'); // ✅ Corrected Foreign Key
    }
}
