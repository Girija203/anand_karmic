<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable=[

        'user_id',
        'product_id',
        'review',
        'rating',
        'status'
    ];

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }
}
