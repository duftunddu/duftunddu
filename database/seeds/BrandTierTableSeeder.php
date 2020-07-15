<?php

use App\Brand_Tier;
use Illuminate\Database\Seeder;

class BrandTierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'         => 1,
                'name'       => 'Low-End',
            ],
            [
                'id'         => 2,
                'name'       => 'Low',
            ],
            [
                'id'         => 3,
                'name'       => 'Mid',
            ],
            [
                'id'         => 4,
                'name'       => 'High',
            ],
            [
                'id'         => 5,
                'name'       => 'High-End',
            ],
        ];

        Brand_Tier::insert($data);
    }
}
