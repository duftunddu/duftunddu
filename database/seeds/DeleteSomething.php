<?php

use Carbon\Carbon;

use App\User;
use App\Request_Brand;
use App\Search_Queries;
use App\Feature_Request;
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
        // Request_Brand::where('name','Test Brand')->delete();
        Request_Brand::where('name','J.')->update(['status'=>'Queued']);
        
        // To add records to search queries. 
        // $date = Carbon::today()->subDays(1);
        
        // for($i =0; $i<8; $i++){
        //     Search_Queries::create([
        //         'created_at'=>$date,
        //         'location_id'=>'25',
        //         'query'=>'ein',
        //         ]);
        // }
    }
}
