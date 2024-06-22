<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
     protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->slug,
            'image' => $this->faker->imageUrl,
            'video' => $this->faker->url,
            'category_id' => 1,
            'subcategory_id' => 1,
            'childcategory_id' => 1,
            'brand_id' => 1,
            'short_description' => $this->faker->paragraph,
            'long_description' => $this->faker->text,
            'sku' => $this->faker->unique()->numerify('SKU-####'),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'offer_price' => $this->faker->randomFloat(2, 5, 90),
            'qty' => $this->faker->numberBetween(1, 100),
            'is_top' => $this->faker->boolean,
            'new_product' => $this->faker->boolean,
            'is_best' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'is_specification' => $this->faker->boolean,
            'is_sold' => $this->faker->boolean,
            'status' => $this->faker->boolean
        ];
    }}
