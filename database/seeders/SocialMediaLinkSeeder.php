<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMediaLink;

class SocialMediaLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SocialMediaLink::create([
            'link' => 'https://facebook.com',
            'icon' => 'fab fa-facebook' 
        ]);
        SocialMediaLink::create([
            'link' => 'https://instagram.com',
            'icon' => 'fa-brands fa-instagram'
        ]);

        SocialMediaLink::create([
            'link' => 'https://twitter.com',
            'icon' => 'fa-brands fa-twitter' 
        ]);
        
        SocialMediaLink::create([
            'link' => 'https://youtube.com',
            'icon' => 'fa-brands fa-youtube'
        ]);
        SocialMediaLink::create([
            'link' => 'https://in.linkedin.com',
            'icon' => 'fa-brands fa-linkedin'
        ]);
        
    }
}
