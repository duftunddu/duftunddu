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

use Carbon\Carbon;
use App\Helper\Helper;

class Controller extends BaseController {
    use AuthorizesRequests,
    DispatchesJobs,
    ValidatesRequests;
    
    public function landing_page(){
        return view('forms.welcome');
        // $agent = new Agent();
        
        // if($agent->isDesktop()){
        //     return view('forms.welcome');
        // }
        // else{
        //     return view('forms.welcome_m');
        // }
    }

    public function cities_of_country(Request $request)
    {
        $cities = Country_And_City::select('city_name')->where('country_name', $request->country)->get();
        $cities = json_encode($cities);

        return $cities;
    }

    public function try () {
        $accords=accord::pluck('name')->toArray();
        // var_dump($accords); return;
        return view('forms.try', [ 'countries'=> $accords]);
    }

    public function try_output (Request $request) {
        $accords=$request->accord_ids;
        var_dump($accords);
        return;
        return view('forms.try_output');
    }
    public function ad_index() {
    
        $no_of_views = collect([
            ['id' => 1, 'count' => '1500',      'cost' => '4'],
            ['id' => 2, 'count' => '1250',      'cost' => '3.4'],
            ['id' => 3, 'count' => '1000',      'cost' => '3'],
        ]);
        //<img class="something" alt="Picture" src="{{ asset('images/folder/another-folder/pic_name.png') }}">
        $pages = collect([
            ['id' => 1, 'name' => 'Fragrance',         'views' => '500'],
            ['id' => 2, 'name' => 'Search Results',    'views' => '150'],
            ['id' => 3, 'name' => 'Search Engine',     'views' => '200'],
            ['id' => 4, 'name' => 'Others',            'views' => '300'],
        ]);
        //we'll sort this array/collection
    
        $pages_images = collect([
            ['id' => 1, 'name' => 'Fragrance',         'string' => '/images/abstract/pawel-czerwinski-tMbQpdguDVQ-unsplash_use.jpg'],
            ['id' => 2, 'name' => 'Search Results',    'string' => '/images/abstract/pawel-czerwinski-tMbQpdguDVQ-unsplash_use.jpg'],
            ['id' => 3, 'name' => 'Search Engine',     'string' => '/images/abstract/pawel-czerwinski-tMbQpdguDVQ-unsplash_use.jpg'],
            ['id' => 4, 'name' => 'Others',            'string' => '/images/abstract/pawel-czerwinski-tMbQpdguDVQ-unsplash_use.jpg'],
        ]);
    
        //I don't know how right now but I'll write a function so that it is always in 
        //the correct order.
        //rates are in $, so show the sign
        $pages_rates = collect([
            ['id' => 1, 'name' => 'Fragrance',         'rate' => '1.8'],
            ['id' => 2, 'name' => 'Search Results',    'rate' => '1.5'],
            ['id' => 3, 'name' => 'Search Engine',     'rate' => '1.2'],
            ['id' => 4, 'name' => 'Others',            'rate' => '1'],
        ]);
        
        
    
        //$tiers = Tiers:: I'll write it at the time.
        // name is also value, value != rate
        $tiers = collect([
            ['id' => 1, 'name' => 'Tier 2', 'visitors' => '300'],
            ['id' => 2, 'name' => 'Tier 3', 'visitors' => '200'],
            ['id' => 3, 'name' => 'Tier 1', 'visitors' => '400'],
            ['id' => 4, 'name' => 'Tier 4', 'visitors' => '100'],
            ['id' => 5, 'name' => 'Tier 5', 'visitors' => '50',],
    
        ]);
    
        $tiers_rates = collect([
            ['id' => 1, 'name' => 'Tier 1', 'rate' => '1'],
            ['id' => 2, 'name' => 'Tier 2', 'rate' => '1.1'],
            ['id' => 3, 'name' => 'Tier 3', 'rate' => '1.2'],
            ['id' => 4, 'name' => 'Tier 4', 'rate' => '1.3'],
            ['id' => 5, 'name' => 'Tier 5', 'rate' => '1.4',],
    
        ]);
    
    
        //$countries = Country_And_City::distinct();
        // name is also value, value != rate
        $countries = collect([
            ['id' => 1, 'name' => 'Pakistan',  'count' => '350'],
            ['id' => 2, 'name' => 'US',        'count' => '400'],
            ['id' => 3, 'name' => 'UAE',       'count' => '240'],
            ['id' => 4, 'name' => 'UK',        'count' => '410'],
            ['id' => 5, 'name' => 'France',    'count' => '200'],
            ['id' => 6, 'name' => 'Germany',   'count' => '100'],
        ]);
    
        $all_countries = collect([
            ['name' => 'All',       'count' => '1000'],
        ]);
    
    
        //The collections from database are complex and you usually can't inert or merge stuff
        //So gonnna have to create the all countries one separately.
        $countries_rates = collect([
            ['id' => 1, 'name' => 'Pakistan',  'rate' => '1'],
            ['id' => 2, 'name' => 'US',        'rate' => '1.4'],
            ['id' => 3, 'name' => 'UAE',       'rate' => '1.2'],
            ['id' => 4, 'name' => 'UK',        'rate' => '1.3'],
            ['id' => 5, 'name' => 'France',    'rate' => '1.2'],
            ['id' => 6, 'name' => 'Germany',   'rate' => '1.1'],
        ]);
    
        $all_countries_rate = collect([
            ['name' => 'All',       'rate' => '1'],
        ]);
    
    
    
        //Helper code for you
    
        //For picture
        //<img class="something" alt="Picture" src="{{ asset('images/folder/another-folder/pic_name.png') }}">
        //for each:
        //@foreach($pages_images as $page_image)
        //  <img class="something" alt="Picture" src="{{ asset('images/{{$page_image}}') }}">
        //@endforeach
        
    
        //to get json
        //$countries->toJson(); 
        //where $countries is a collection. collect makes collections
    
    
        //In blade use
        //@foreach($countries as $country)
        //  {{$country['name']}}
        //@endforeach
        
        return ['pages' => $pages, 'tiers' => $tiers, 'countries' => $countries,
                'rates' => [
                    'pages' => $pages_rates,
                    'tiers' => $tiers_rates,
                    'countries' => $countries_rates,
                    'views' => $no_of_views
                ],
                'images' => $pages_images
        ];
    }
    
    public function ad_store(Request $request){
        //expected values = all the selected values
    
        var_dump($request);
        return;
    }
}