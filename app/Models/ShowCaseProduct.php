<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowCaseProduct extends Model
{
    use HasFactory;

    protected $fillable=[
        
        'product_id',
        'product_show_cases_id',
        'updated_by',
        'status'
       
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productShowCase()
    {
        return $this->belongsTo(ProductShowCase::class, 'product_show_cases_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

     public function getPriceInSelectedCurrency()
{
    $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
    $priceInSelectedCurrency = $this->price * $exchangeRate;
    return $priceInSelectedCurrency;
}

public function getOfferPriceInSelectedCurrency()
{
    $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
    $offerPriceInSelectedCurrency = $this->offer_price * $exchangeRate;
    return $offerPriceInSelectedCurrency;
}

}
