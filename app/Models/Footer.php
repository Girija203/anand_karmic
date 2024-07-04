<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [

        'about_us',
        'phone',
        'email',
        'address',
        'first_column',
        'second_column',
        'third_column',
        'copyright'
    ];
}
