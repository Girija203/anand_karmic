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
}
