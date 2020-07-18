<?php

use App\Accord;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AccordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accord')->truncate();

        $data = [
            [
                'id'         => 1,
                'name'       => 'Spicy',
            ],
            [
                'id'         => 2,
                'name'       => 'Creamy',
            ],
            [
                'id'         => 3,
                'name'       => 'Icy',
            ],
            [
                'id'         => 4,
                'name'       => 'Smoky',
            ],
        ];

        Accord::insert($data);
    }
}
