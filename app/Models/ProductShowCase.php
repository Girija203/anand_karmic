<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShowCase extends Model
{
    use HasFactory;
     protected $fillable=[
        
        'title',
        'description',
        'image',
        'status'
       
    ];

    public function showCaseProducts()
    {
        return $this->hasMany(ShowCaseProduct::class, 'product_show_cases_id');
    }
}
