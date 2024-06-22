<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $states = [
            ['country_id' => 1, 'name' => 'Undefined'],
            ['country_id' => 2, 'name' => 'Tamil Nadu'],
        
            // Add more states as needed
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
