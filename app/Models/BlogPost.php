<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'is_draft',
        'views',
        'featured_image',
        'published_at',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function metaDetails()
    {
        return $this->hasMany(MetaDetail::class, 'blog_posts_id');
    }
}
