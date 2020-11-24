<?php

use Illuminate\Database\Seeder;

class ChangeMigrationBatch extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //2020_11_07_174206_create_country_and_city_table
        DB::update('update migrations set batch = ? where migration = ?',['50','2020_11_07_174206_create_country_and_city_table']); 
    }
}
