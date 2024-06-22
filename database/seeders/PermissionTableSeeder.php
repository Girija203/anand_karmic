<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $permission = [
            
            [
                'name' => 'Settings Read',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name' => 'Settings Write',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name' => 'Settings Update',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name' => 'Settings Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
           
            
            [
                'name' => 'Users Read',
                'permission_group_id' => PermissionGroup::where('name', 'Users')->first()->id
            ],
            [
                'name' => 'Users Write',
                'permission_group_id' => PermissionGroup::where('name', 'Users')->first()->id
            ],
            [
                'name' => 'Users Update',
                'permission_group_id' => PermissionGroup::where('name', 'Users')->first()->id
            ],
            [
                'name' => 'Users Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Users')->first()->id
            ],
          
            [
                'name' => 'Permissions Read',
                'permission_group_id' => PermissionGroup::where('name', 'Permissions')->first()->id
            ],
            [
                'name' => 'Permissions Write',
                'permission_group_id' => PermissionGroup::where('name', 'Permissions')->first()->id
            ],
            [
                'name' => 'Permissions Update',
                'permission_group_id' => PermissionGroup::where('name', 'Permissions')->first()->id
            ],
            [
                'name' => 'Permissions Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Permissions')->first()->id
            ],
       
            [
                'name' => 'Roles Read',
                'permission_group_id' => PermissionGroup::where('name', 'Roles')->first()->id
            ],
            [
                'name' => 'Roles Create',
                'permission_group_id' => PermissionGroup::where('name', 'Roles')->first()->id
            ],
            [
                'name' => 'Roles Update',
                'permission_group_id' => PermissionGroup::where('name', 'Roles')->first()->id
            ],
            [
                'name' => 'Roles Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Roles')->first()->id
            ],

            [
                'name' => 'Country Read',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id
            ],
            [
                'name' => 'Country Create',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id
            ],
            [
                'name' => 'Country Update',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id
            ],
            [
                'name' => 'Country Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id
            ],
            [
                'name' => 'Cokkie Consents Read',
                'permission_group_id' => PermissionGroup::where('name', 'Cokkie Consents')->first()->id
            ],
            [
                'name' => 'Cokkie Consents Create',
                'permission_group_id' => PermissionGroup::where('name', 'Cokkie Consents')->first()->id
            ],
            [
                'name' => 'Cokkie Consents Update',
                'permission_group_id' => PermissionGroup::where('name', 'Cokkie Consents')->first()->id
            ],
            [
                'name' => 'Cokkie Consents Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Cokkie Consents')->first()->id
            ],

            [
                'name' => 'Email Configuration Read',
                'permission_group_id' => PermissionGroup::where('name', 'Email Configuration')->first()->id
            ],
            [
                'name' => 'Email Configuration Create',
                'permission_group_id' => PermissionGroup::where('name', 'Email Configuration')->first()->id
            ],
            [
                'name' => 'Email Configuration Update',
                'permission_group_id' => PermissionGroup::where('name', 'Email Configuration')->first()->id
            ],
            [
                'name' => 'Email Configuration Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Email Configuration')->first()->id
            ],

            [
                'name' => 'Email Templates Read',
                'permission_group_id' => PermissionGroup::where('name', 'Email Templates')->first()->id
            ],
            [
                'name' => 'Email Templates Create',
                'permission_group_id' => PermissionGroup::where('name', 'Email Templates')->first()->id
            ],
            [
                'name' => 'Email Templates Update',
                'permission_group_id' => PermissionGroup::where('name', 'Email Templates')->first()->id
            ],
            [
                'name' => 'Email Templates Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Email Templates')->first()->id
            ],





        ];

        echo '---------------------------------------' . "\n";
        echo '--------Permission Seeding-------' . "\n";

        foreach ($permission as $key => $value) {
            $permission = new Permission;
            $permission->name = $value['name'];
            $permission->permission_group_id = $value['permission_group_id'];
            $permission->save();
            echo "-------Permission Name=> $permission->name--------------" . "\n";
        }
        echo "-------Permission Seeding Completed--------------" . "\n";
    }
}
