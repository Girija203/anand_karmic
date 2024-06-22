<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $datas = [
            [
                'name' => 'Undefined',
                'slug' => 'undefined',
                'status' => 1,
            ],
            [
                'name' => 'Inovera',
                'slug' => 'inovera',
                'status' => 1,
            ]
        ];

        foreach ($datas as $data) {
            Brand::create($data);
        }
    }
}
