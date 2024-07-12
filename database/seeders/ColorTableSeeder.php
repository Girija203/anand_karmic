<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name' => "Undefined", 'code' => '#ffffff'],
            ['name' => "red", 'code' => '#d41111'],
        ];

        foreach ($datas as $data) {
            Color::create($data);
        }
    }
}
