<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    protected $fillable=[

        'product_id',       
        'meta_keys_id',
        'content',
    ];
    public function metaKey()
    {
        return $this->belongsTo(MetaKey::class, 'meta_keys_id');
    }
    
}
