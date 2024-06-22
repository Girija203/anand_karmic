<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $datas = array(
            array(
                'site_title' => "Dyanmic",
                // 'logo' => 'N/S',
                // 'favicon' => 'N/S',
                // 'contact_email' => 'N/S',
                // 'enable_save_contact_message' => 'N/S',
                // 'timezone' => 'N/S',
                // 'sidebar_lg_header' => 'N/S',
                // 'sidebar_sm_header' => 'N/S',
                // 'topbar_phone' => 'N/S',
                // 'topbar_email' => 'N/S',
                'primary_color' => '#ff8585',
                'secondary_color' => '#ff8585',
                // 'frontend_url' => 'N/S',
                // 'error' => 'N/S',
                'current_version' => '1',
            )

        );

        DB::table('settings')->insert($datas);
    }
}
