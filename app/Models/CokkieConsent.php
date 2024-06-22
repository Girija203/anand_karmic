<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CokkieConsent extends Model
{
    use HasFactory;

     protected $fillable = [
        'message',
        'link_text',
        'link',
        'status'
    ];
}
