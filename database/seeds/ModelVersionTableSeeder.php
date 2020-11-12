<?php

use App\Model_Version;
use Illuminate\Database\Seeder;

class ModelVersionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first = Model_Version::firstOrCreate([
            'users_id'  => 1,
            'type'      => 'affecting_factors',
            'version'   => 1,
        ]);
    }
}
