<?php

use App\Fragrance_Brand;
use Illuminate\Database\Seeder;

class DeleteSomething extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fragrance_Brand::where('name',"DummyTestBrand")->first()->delete();
    }
}
