<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id ',
        'color_id',
        'price',
        'offer_price',
        'qty',
        'single_image'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
