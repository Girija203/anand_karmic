<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
        $cities = [
            ['country_id' => 1, 'state_id' => 1, 'name' => 'Undefined'],
            ['country_id' => 2, 'state_id' => 2, 'name' => 'Cuddalore'],
        
            // Add more cities as needed
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
