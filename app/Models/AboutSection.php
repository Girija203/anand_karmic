<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'content',
        'is_left',
        'position'

    ];

    public function images()
    {
        return $this->hasMany(AboutSectionImage::class);
    }

}
