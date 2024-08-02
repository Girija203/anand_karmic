<?php

namespace Database\Seeders;

use App\Models\CouponType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the data to be seeded
        $couponTypes = [
            [
                'name' => 'General Coupon',
                'code' => 'GC',
                'status' => 1
            ],
            [
                'name' => 'User Coupon',
                'code' => 'UC',
                'status' => 1
            ],
            [
                'name' => 'Product Coupon',
                'code' => 'PC',
                'status' => 1
            ],
            [
                'name' => 'User Product Coupon',
                'code' => 'UPC',
                'status' => 1
            ]
        ];

        // Insert the data into the database
        foreach ($couponTypes as $couponType) {
            CouponType::create($couponType);
        }
    }
}
