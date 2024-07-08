<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FooterLink;

class FooterLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example data for first column
        FooterLink::create([
            'column' => 1,
            'title' => 'About Us',
            'link' => '/about'
        ]);

        FooterLink::create([
            'column' => 1,
            'title' => 'Contact Us',
            'link' => '/contact'
        ]);

        // Example data for second column
        FooterLink::create([
            'column' => 2,
            'title' => 'Team & Conditions',
            'link' => '/terms_condition'
        ]);

      
        // Example data for third column
        FooterLink::create([
            'column' => 3,
            'title' => 'Privacy policy',
            'link' => '/privacy_policy'
        ]);

       

        
    }
}
