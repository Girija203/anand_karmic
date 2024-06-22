<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[

        'title',
        'slug',
        'image',
        'video',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'short_description',
        'long_description',
        'sku',
        'price',
        'offer_price',
        'qty',
        'is_top',
        'new_product',
        'is_best',
        'is_featured',
        'is_specification',
        'is_sold',
        'status'

    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class, 'childcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

     public function images()
    {
        return $this->hasMany(ProductMultipleImage::class, 'product_id');
    }
     public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }
    public function reviews()
{
    return $this->hasMany(ProductReview::class);
}

 public function showCaseProducts()
    {
        return $this->hasMany(ShowCaseProduct::class, 'product_id');
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

