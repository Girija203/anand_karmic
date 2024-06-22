<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroup = [
            [
                'name' => 'Individual'                                                                                                             
            ],
            
            [
                'name' => 'Settings'
            ],
        
            [
                'name' => 'Users'
            ],
            [
                'name' => 'Permissions'
            ],
            [
                'name' => 'Roles'
            ],
            [
                'name' => 'Country'
            ],
             [
                'name' => 'Cokkie Consents'
            ],
            [
                'name' => 'Email Configuration'
            ],
            [
                'name' => 'Email Templates'
            ],
            
        
            
            
            
            
            
           
            

        ];

        echo '---------------------------------------' . "\n";
        echo '--------Permission Group Seeding-------' . "\n";

        foreach ($permissionGroup as $key => $value) {
            $permissionGroup = new PermissionGroup();
            $permissionGroup->name = $value['name'];
            $permissionGroup->save();
            echo "-------Permission Group Name=> $permissionGroup->name--------------" . "\n";
        }
        echo "-------Permission Group Seeding Completed--------------" . "\n";
    }
}
