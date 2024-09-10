<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantColor extends Model
{
    use HasFactory;

    protected $fillable = [

        'main_product_id',
        'color_id',
        'product_id',
    ];

    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'main_product_id');
    }

    // Relationship to the specific variant product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
