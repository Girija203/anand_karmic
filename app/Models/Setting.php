<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'maintenance_mode',
        'logo',
        'favicon',
        'contact_email',
        'enable_save_contact_message',
        'timezone',
        'sidebar_lg_header',
        'sidebar_sm_header',
        'topbar_phone',
        'topbar_email',
        'primary_color',
        'secondary_color',
        'frontend_url',
        'error',
        'current_version'
        
    ];
}
