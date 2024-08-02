<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'user_id',
        'total_amount',
        'product_qty',
        'payment_method',
        'payment_status',
        'payment_approval_date',
        'transection_id',
        'shipping_method',
        'shipping_cost',
        'coupon_cost',
        'order_status',
        'order_approval_date',
        'order_delivered_date',
        'order_completed_date',
        'order_declined_date',
        'delivery_man_id',
        'order_request',
        'order_req_date',
        'cash_on_delivery'

    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
