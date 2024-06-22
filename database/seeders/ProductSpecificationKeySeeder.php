<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductSpecificationKey;

class ProductSpecificationKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $productSpecificationKeys = [
            ['name' => 'Color'],
            ['name' => 'Size'],
        ];

        foreach ($productSpecificationKeys as $productSpecificationKey) {
            ProductSpecificationKey::create($productSpecificationKey);
        }
    }
}
