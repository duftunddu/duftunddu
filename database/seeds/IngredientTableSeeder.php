<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
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
                'name'       => 'Musk',
            ],
            [
                'id'         => 2,
                'name'       => 'Wood',
            ],
            [
                'id'         => 3,
                'name'       => 'Amber',
            ],
        ];

        Ingredient::insert($data);
    }
}
