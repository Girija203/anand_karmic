<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSectionImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'about_section_id',
        'image',
        
    ];
}
