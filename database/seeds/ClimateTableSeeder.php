<?php

use App\Climate;
use Illuminate\Database\Seeder;

class ClimateTableSeeder extends Seeder
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
                'name'       => 'Tropical (Hot & Humid)',
            ],
            [
                'id'         => 2,
                'name'       => 'Dry',
            ],
            [
                'id'         => 3,
                'name'       => 'Temperate (Warm & Mild Winter)',
            ],
            [
                'id'         => 4,
                'name'       => 'Continental (Usually Cold)',
            ],
            [
                'id'         => 5,
                'name'       => 'Polar (Always Cold)',
            ],
        ];

        Climate::insert($data);
    }
}
