<?php

use App\Skin_Type;
use Illuminate\Database\Seeder;

class SkinTypeTableSeeder extends Seeder
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
                'name'       => 'Dry',
            ],
            [
                'id'         => 2,
                'name'       => 'Dry & Moisturized',
            ],
            [
                'id'         => 3,
                'name'       => 'Normal',
            ],
            [
                'id'         => 4,
                'name'       => 'Oily',
            ],
            [
                'id'         => 5,
                'name'       => 'Very Oily',
            ],
        ];

        Skin_Type::insert($data);
    }
}
