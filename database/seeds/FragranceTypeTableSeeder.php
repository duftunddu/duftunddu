<?php

use App\Fragrance_Type;
use Illuminate\Database\Seeder;

class FragranceTypeTableSeeder extends Seeder
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
                'name'       => 'Parfum (Perfume)',
            ],
            [
                'id'         => 2,
                'name'       => 'Eau de Parfum',
            ],
            [
                'id'         => 3,
                'name'       => 'Eau de Toilette',
            ],
            [
                'id'         => 4,
                'name'       => 'Eau de Cologne',
            ],
            [
                'id'         => 5,
                'name'       => 'Eau Fraiche',
            ],
            [
                'id'         => 6,
                'name'       => 'Attar',
            ],
            [
                'id'         => 7,
                'name'       => 'Mist',
            ],
        ];

        Fragrance_Type::insert($data);
    }
}
