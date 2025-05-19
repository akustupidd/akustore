<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $table = 'blog_comments';

    protected $fillable = ['blog_post_id', 'customer_id', 'comment', 'parent_id'];

    // ✅ Relationship to the Parent Comment (for replies)
    public function parent()
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    // ✅ Relationship to Fetch Replies
    public function replies()
    {
        return $this->hasMany(BlogComment::class, 'parent_id')->with('replies'); // 🔥 Allows unlimited levels of replies
    }
    // Relationship: BlogComment belongs to a Blog
    public function blog() {
        return $this->belongsTo(Blog::class, 'blog_post_id');
    }

    // Relationship: BlogComment belongs to an Admin (Optional)
    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Relationship: BlogComment belongs to a Customer (Optional)
    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
