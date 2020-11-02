<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->truncate();

        // User
        // fill_user_profile	new_user
        $role = Role::firstOrCreate(['name' => 'new_user']);
        $role->givePermissionTo('fill_user_profile');

        // user_dashboard_access, add_profile, edit_user_profile, add_perceived_fragrance, add_profile_perceived_fragrance	user
        $role = Role::firstOrCreate(['name' => 'user']);
        $role->givePermissionTo('user_dashboard_access');
        $role->givePermissionTo('add_profile');
        $role->givePermissionTo('edit_user_profile');
        $role->givePermissionTo('add_perceived_fragrance');
        $role->givePermissionTo('add_profile_perceived_fragrance');

        // [all of the above], get_prediction	genie_user
        $role = Role::firstOrCreate(['name' => 'genie_user']);
        $role->givePermissionTo('get_prediction');
        $role->givePermissionTo('user_dashboard_access');
        $role->givePermissionTo('add_profile');
        $role->givePermissionTo('edit_user_profile');
        $role->givePermissionTo('add_perceived_fragrance');
        $role->givePermissionTo('add_profile_perceived_fragrance');
        // Can be used for self and for others
        
        // [all of the above], get_user_analytics	premium_user
        $role = Role::firstOrCreate(['name' => 'premium_user']);
        $role->givePermissionTo('get_user_analytics');
        $role->givePermissionTo('get_prediction');
        $role->givePermissionTo('user_dashboard_access');
        $role->givePermissionTo('add_profile');
        $role->givePermissionTo('edit_user_profile');
        $role->givePermissionTo('add_perceived_fragrance');
        $role->givePermissionTo('add_profile_perceived_fragrance');
        // can only be used for self 


        // Brand Ambassador
        // edit_ba_profile	candidate_brand_ambassador
        $role = Role::firstOrCreate(['name' => 'candidate_brand_ambassador']);
        $role->givePermissionTo('edit_ba_profile');
        
        // add brand	new_brand_ambassador
        $role = Role::firstOrCreate(['name' => 'new_brand_ambassador']);
        // $role->givePermissionTo('edit_ba_profile');
        

        // [all of the above], brand_dashboard_access, add_brand_fragrance, edit_brand_fragrance	brand_ambassador
        $role = Role::firstOrCreate(['name' => 'brand_ambassador']);
        $role->givePermissionTo('brand_dashboard_access');
        $role->givePermissionTo('add_brand_fragrance');
        $role->givePermissionTo('edit_brand_fragrance');
        $role->givePermissionTo('edit_ba_profile');
            
        // [all of the above], get_brand_analytics	premium_brand_ambassador
        $role = Role::firstOrCreate(['name' => 'premium_brand_ambassador']);
        $role->givePermissionTo('get_brand_analytics');
        $role->givePermissionTo('brand_dashboard_access');
        $role->givePermissionTo('add_brand_fragrance');
        $role->givePermissionTo('edit_brand_fragrance');
        $role->givePermissionTo('edit_ba_profile');

        // admin
        $role = Role::firstOrCreate(['name' => 'admin']);
        
        // $role->givePermissionTo('fill_user_profile');

        // $role->givePermissionTo('get_user_analytics');
        // $role->givePermissionTo('get_prediction');
        // $role->givePermissionTo('user_dashboard_access');
        // $role->givePermissionTo('add_profile');
        // $role->givePermissionTo('edit_user_profile');
        // $role->givePermissionTo('add_perceived_fragrance');
        // $role->givePermissionTo('add_profile_perceived_fragrance');
        
        // $role->givePermissionTo('get_gift_prediction');
        
        // $role->givePermissionTo('get_brand_analytics');
        // $role->givePermissionTo('brand_dashboard_access');
        // $role->givePermissionTo('add_brand_fragrance');
        // $role->givePermissionTo('edit_brand_fragrance');
        // $role->givePermissionTo('edit_ba_profile');

    }
}
