<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_color_id',
        'multi_image'
    ];
    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
}
