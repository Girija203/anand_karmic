<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'blog_post_id',
    ];

}
