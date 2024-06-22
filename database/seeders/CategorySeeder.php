<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $categories = [
            ['name' => 'Undefined', 'slug' => 'category-undefined', 'status' => 1],
            ['name' => 'Woman', 'slug' => 'category-woman', 'status' => 1],
            ['name' => 'Men', 'slug' => 'category-men', 'status' => 1],
            // Add more categories as needed
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
