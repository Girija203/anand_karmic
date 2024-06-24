<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSMLShare extends Model
{
    use HasFactory;

     protected $fillable=[
        
        'name',
        'link',
        'icon'
       
    ];

}
