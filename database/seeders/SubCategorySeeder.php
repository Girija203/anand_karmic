<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $subcategories = [
            ['category_id' => 1, 'name' => 'Undefined', 'slug' => 'sub-category-undefined', 'status' => 1],
            ['category_id' => 2, 'name' => 'Hand Bags', 'slug' => 'sub-category-handbags', 'status' => 1],
            // Add more subcategories as needed
        ];

        foreach ($subcategories as $subcategory) {
            SubCategory::create($subcategory);
        }
    }
}
