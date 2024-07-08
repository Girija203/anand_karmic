<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Footer;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Footer::create([
            'about_us' => 'Welcome to Karmic Bag, where fashion meets functionality in every handcrafted piece. Established with a passion for exquisite craftsmanship and timeless style, we curate a collection of handbags that embody elegance and practicality',
            'phone' => '123-456-7890',
            'email' => 'info@example.com',
            'address' => '123 Main St, City, Country',
            'first_column' => 'Company Info',
            'second_column' => 'Help Support',
            'third_column' => 'Customer Care',
            'copyright' => '© 2024 Karmic Bag'
        ]);
    }
}
