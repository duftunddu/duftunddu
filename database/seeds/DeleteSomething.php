<?php

use App\Fragrance_Brand;
use App\User;
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
        User::where('name','Cocaine Wraith')->update(['name' => "Daaniyal Riaz"]);
    }
}
