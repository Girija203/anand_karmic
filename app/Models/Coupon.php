<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=[
        'coupon_type_id',
        'name',
        'code',  
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'usage_limit',
        'usage_count',
        'minimum_purchase_price',
        'status'
    ];

    public function couponType()
    {
        return $this->belongsTo(CouponType::class);
    }
}
