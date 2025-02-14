<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
class PermissionGroup extends Model
{
    use HasFactory;
 protected $fillable=['name'];
     public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permissions', 'id','permission_group_id');
    }

    
}
