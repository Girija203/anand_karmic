<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->delete();
        echo '---------------------------------------' . "\n";
        echo '--------User Seeding-------' . "\n";
        $datas = [
            [
                'name' => 'Developer',
                'email' => 'developer@syscorp.in',
                'password' => 'coconut143',
                'phone' => '7894651320'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin@123',
                'phone' => '1234657980'
            ],

        ];


        foreach ($datas as $key => $value) {
            $data = new User();
            $data->name = $value['name'];
            $data->email = $value['email'];
            $data->password = $value['password'];
            $data->save();
            echo "-------Roles Name=> $data->name --------------" . "\n";
        }

    }
}
