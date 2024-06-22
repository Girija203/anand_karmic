<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'shipping_rule',
        'type',
        'condition_from',
        'condition_to',
        'shipping_fee'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
