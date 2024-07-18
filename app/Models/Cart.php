<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

     protected $fillable=[

        'product_id',
        'name',  
        'price',
        'quantity',
        'image',
    ];

     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
    
}
