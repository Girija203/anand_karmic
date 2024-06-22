<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChildCategory;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
        $childcategories = [
            ['category_id' => 1, 'subcategory_id' => 1, 'name' => 'Undefined', 'slug' => 'child-category-undefiend', 'status' => 1],
            ['category_id' => 2, 'subcategory_id' => 2, 'name' => 'Childcategory1', 'slug' => 'child-category-normal', 'status' => 1],
            // Add more childcategories as needed
        ];

        foreach ($childcategories as $childcategory) {
            ChildCategory::create($childcategory);
        }
    }
}
