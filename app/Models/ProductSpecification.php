<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'product_id',
        'product_specification_key_id',
        'specification',
    ];

    public function key()
{
    return $this->belongsTo(ProductSpecificationKey::class, 'product_specification_key_id');
}

 public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
