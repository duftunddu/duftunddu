<?php

use App\User;
use App\Request_Brand;
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
        // Fragrance_Brand::where('name',"DummyTestBrand")->first()->delete();
        // User::where('name','Cocaine Wraith')->update(['name' => "Daaniyal Riaz"]);
        Request_Brand::where('name','Test Brand')->delete();
    }
}
