<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetaType;

class MetaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $metaTypes = [
            ['name' => 'Name'],
            ['name' => 'Property'],
        ];

        foreach ($metaTypes as $metaType) {
            MetaType::create($metaType);
        }
    }
    }

