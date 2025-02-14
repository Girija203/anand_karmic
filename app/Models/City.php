<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

      protected $fillable = [
        'country_id',
        'state_id',
        'name',
        'code'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
     public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
