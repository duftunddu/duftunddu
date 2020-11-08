<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Brand;
use App\Country_And_City;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class Controller extends BaseController {
    use AuthorizesRequests,
    DispatchesJobs,
    ValidatesRequests;
    
    public function landing_page(){
        $agent = new Agent();
        return view('forms.welcome');
        
        if($agent->isDesktop()){
            return view('forms.welcome');
        }
        else{
            return view('forms.welcome_m');
        }
    }

    public function cities_of_country(Request $request)
    {
        $cities = Country_And_City::select('city_name')->where('country_name', $request->country)->get();
        $cities = json_encode($cities);

        return $cities;
    }

  
    public function request_feature_show(){
      return view('forms.request_feature');
    }

    public function request_feature(Request $request){

    }

    public function try () {
        $accords=accord::all();
        return view('forms.try', [ 'countries'=> $accords]);
    }

    public function try_output (Request $request) {
        $accords=$request->accord_ids;
        var_dump($accords);
        return;
        return view('forms.try_output');
    }


    public function factors_affecting_fragrance(Request $request){
        // var_dump($request->value);
        // var_dump($request->type);

        echo $request->value;
        echo $request->type;
        
        return;
    }
}