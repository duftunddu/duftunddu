<?php

use App\Season;
use Illuminate\Database\Seeder;

class SeasonTableSeeder extends Seeder
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
                'name'       => 'Summer',
            ],
            [
                'id'         => 2,
                'name'       => 'Winter',
            ],
            [
                'id'         => 3,
                'name'       => 'Spring',
            ],
            [
                'id'         => 4,
                'name'       => 'Autumn',
            ],
        ];

        Season::insert($data);
    }
}
