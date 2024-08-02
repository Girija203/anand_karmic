<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\CommonMark\Extension\Footnote\Node\FootnoteBackref;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Developer',
        //     'email' => 'developer@syscorp.in',
        // ]);

        $this->call([
            PermissionGroupTableSeeder::class,
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            UserTableSeeder::class,
            SettingTableSeeder::class,
            MetaTypeSeeder::class,
            MetaKeySeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            ChildCategorySeeder::class,
            ProductSpecificationKeySeeder::class,
            FooterSeeder::class,
            SocialMediaLinkSeeder::class,
            FooterLinkSeeder::class,
            ColorTableSeeder::class,
            CouponTypeTableSeeder::class
            // ProductSeeder::class,
             
        ]);
    }
}
