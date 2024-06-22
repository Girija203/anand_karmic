<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MetaType;
use App\Models\MetaKey;

class MetaKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metaTypes = MetaType::all();

     

        $metaKeys = [
            ['meta_types_id' => $metaTypes[0]->id, 'name' => 'Title'],
            ['meta_types_id' => $metaTypes[0]->id, 'name' => 'Description'],
            ['meta_types_id' => $metaTypes[1]->id, 'name' => 'og_title'],
            ['meta_types_id' => $metaTypes[1]->id, 'name' => 'og_url'],
       
            
        ];

        foreach ($metaKeys as $metaKey) {
            MetaKey::create($metaKey);
        }
    }
    }

