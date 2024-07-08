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
        'sku',
        'single_image'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function images()
    {
        return $this->hasMany(ProductColorImage::class, 'product_color_id');
    }

}
