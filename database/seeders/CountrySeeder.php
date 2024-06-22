<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name' => 'Undefined', 'code' => 'N/A', 'status' => 1],
            ['name' => 'India', 'code' => 'IND', 'status' => 1],
            // Add more countries as needed
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
