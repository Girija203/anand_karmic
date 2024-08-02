<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    protected $fillable=[

        'user_id',
        'name',
        'email',
        'mobile',
        'country',
        'state',
        'city',
        'address',
        'pincode',
        'type',
        'default_shipping'



    ];

    public static function getBillingAddress($userId)
    {
        return self::where('user_id', $userId)
            ->where('type', 0)
            ->first();
    }

    // Get default shipping address (default_shipping = 1)
    public static function getShippingAddress($userId)
    {
        return self::where('user_id', $userId)
            ->where('default_shipping', 1)
            ->first();
    }
}
