<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_types_id',
        'name',
    ];

    public function metaType()
    {
        return $this->belongsTo(MetaType::class, 'meta_types_id');
    }

}
