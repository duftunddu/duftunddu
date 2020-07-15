<?php

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User
        Permission::firstOrCreate(['name' => 'fill_user_profile']);

        Permission::firstOrCreate(['name' => 'user_dashboard_access']);
        Permission::firstOrCreate(['name' => 'add_profile']);
        Permission::firstOrCreate(['name' => 'edit_user_profile']);
        Permission::firstOrCreate(['name' => 'add_perceived_fragrance']);
        Permission::firstOrCreate(['name' => 'add_profile_perceived_fragrance']);

        Permission::firstOrCreate(['name' => 'get_prediction']);

        Permission::firstOrCreate(['name' => 'get_user_analytics']);

        Permission::firstOrCreate(['name' => 'get_gift_prediction']);
        
        // Brand Ambassador
        Permission::firstOrCreate(['name' => 'edit_ba_profile']);

        Permission::firstOrCreate(['name' => 'brand_dashboard_access']);
        Permission::firstOrCreate(['name' => 'add_brand_fragrance']);
        Permission::firstOrCreate(['name' => 'edit_brand_fragrance']);
        
        Permission::firstOrCreate(['name' => 'get_brand_analytics']);
    }
}
