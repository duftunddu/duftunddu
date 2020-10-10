<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Brand;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Jenssegers\Agent\Agent;

class Controller extends BaseController {
    // use AuthorizesRequests,
    // DispatchesJobs,
    // ValidatesRequests;
    
    public function landing_page(){
        $agent = new Agent();
        
        if($agent->isDesktop()){
            return view('forms.welcome');
        }
        else{
            return view('forms.welcome_m');
        }
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

}