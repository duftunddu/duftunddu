<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Brand;
use App\Country_And_City;
use Illuminate\Support\Facades\DB;

// For Fragrance_Profile
use Auth;
use App\Brand_Ambassador_Profile;
use App\Fragrance_Type;
use App\Season;
use App\Climate;
use App\Skin_Type;
use App\Location;
use App\Profession;
use App\Fragrance_Profile;

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

    // Store
    // index
    public function store_index(){

        // $weights = (object) [
        //     'avg_temp'                    => 5,
        //     'avg_hum'                     => 56,
        //     'bmi'                         => 567,
        //     'fragrance_type_weight'       => 5678,
        //     'humidity_weight'             => "qdsklfsd sdf qsdklf ksd",
        //     'sustainability_heat_weight'  => "djfklsdjfldk",
        //     'warm_cold_weight'            => 5678,
        //     'sweat_weight'                => 567,
        //     'bmi_weight'                  => 56,
        //     'skin_weight'                 => 5
        //   ];

        // $json = json_encode($weights);
        // $json = "https://duftunddu.com/".$json;

        // $json = urlencode($json);

        // var_dump($json);return;
        // var_dump(filter_var($json, FILTER_VALIDATE_URL));return;
        // $myJSON = JSON.stringify(obj);

        // var_dump($json);
        // return;



        // Only allow store owners to access this

        return view('store.landing', [
            // 'countries'=> $accords
        ]);
    }

    // profile_entry
    public function store_profile_entry(){
        // Only allow store owners to access this

        $professions    =   Profession::select('name')->get();
        $skin_types     =   Skin_Type::select('name')->get();
        $climates       =   Climate::select('name')->get();
        $seasons        =   Season::select('name')->get();
        
        $currencies     =   Helper::currencies();

        return view('store.profile_entry',[
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
            'currencies'        =>    $currencies
        ]);
    }

    // show fragrance
    public function store_fragrance_show($id)
    {
        $fragrance = Fragrance::find($id);

        if(is_null($fragrance)){
        return redirect()->route('search');
        }

        $type = Fragrance_Type::find($fragrance->type_id)->first();

        $sillage = (object) [
        'value'       => $fragrance->sillage,
        'percent'     => $fragrance->sillage
        ];
        
        $accords = DB::table('fragrance_accord')
        ->where('fragrance_accord.fragrance_id', $id)
        ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        ->select('accord.name')
        ->pluck('name')
        ->toArray();
        
        $notes = DB::table('fragrance_ingredient')
        ->where('fragrance_ingredient.fragrance_id', $id)
        ->join('ingredient', 'ingredient.id', '=', 'fragrance_ingredient.ingredient_id')
        ->select('ingredient.name', 'fragrance_ingredient.intensity')
        ->orderBy('intensity', 'desc')
        ->get();

        // For Brand Ambassadors
        $allow_edit = FALSE;

        if (Auth::check()) {
        $logged_in = TRUE;
        // If the user is Brand Ambassdor. And if the BA is of this brand.
        if(request()->user()->hasRole(['brand_ambassador', 'premium_brand_ambassador'])){
            $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();
            if($ambassador->brand_id == $fragrance->brand_id){
            $allow_edit = TRUE;
            }
        }

            // If user with complete details, then calculate fragrance suitability, sustainability and longevity
            if(request()->user()->hasRole(['user', 'genie_user', 'premium_user'])){

            $frag_profile = DB::table('fragrance_profile')
                ->where('users_id', request()->user()->id)
                ->join('skin_type', 'skin_type.id', '=', 'fragrance_profile.skin_type_id')
                ->join('climate', 'climate.id', '=', 'fragrance_profile.climate_id')
                ->join('season', 'season.id', '=', 'fragrance_profile.season_id')
                ->select('fragrance_profile.gender', 'fragrance_profile.currency', 'fragrance_profile.location_id', 'fragrance_profile.sweat', 'fragrance_profile.height', 'fragrance_profile.weight', 'skin_type.name as skin', 'climate.name as climate', 'season.name as season')
                ->first();
            
            $user_gender = $frag_profile->gender;

            if($fragrance->currency != $frag_profile->currency){
                $fragrance->cost = Helper::currency_convert($fragrance->cost, $fragrance->currency, $frag_profile->currency);
                $fragrance->currency = $frag_profile->currency;
            }

            $weather_data_json = Helper::weather_data($frag_profile->location_id);

            // var_dump($weather_data_json->successful());return;
            if($weather_data_json->successful()){

                //TODO: Create separate functions for each of the following, fetch weights in those functions from database.   

                // Sum of Weekly Variables
                $sum_temp = 0;
                $sum_hum  = 0;

                for ($i = 0; $i < 8; $i++){
                $sum_temp += $weather_data_json['daily'][$i]['temp']['day'];
                $sum_hum  += $weather_data_json['daily'][$i]['humidity'];
                }

                // Average Temperature
                $avg_temp = $sum_temp/8;

                // Average Humidity
                $avg_hum = $sum_hum/8;

                // Initializing Weights
                // Strength of Fragrance (Experimental)
                $strength_of_fragrance = $notes->pluck('intensity')->take(5)->sum()/5;
                $sustainability = 100;
                $suitability = 100;
                $longevity = 0;
                // Perfume Oil Concentration in %
                // Pure Perfume/Parfum: 15-30 | 100
                // Eau de Parfum (EDP): 15-20 | 90
                // Eau de Toilette (EDT): 5-15 | 80
                // Eau de Cologne: 2-4 | 70
                // Eau Fraiche: 1-3 | 60

                $fragrance_type_weight = (object) [
                    'condition' => NULL,
                    'weight'    => NULL
                ];
                if(strcmp($type->name, "Parfum (Perfume)") == 0){
                $longevity = 80;
                $fragrance_type_weight->condition = "Parfum (Perfume)";
                }
                else if(strcmp($type->name, "Eau de Parfum") == 0){
                $longevity = 90;
                $fragrance_type_weight->condition = "Eau de Parfum";
                }
                else if(strcmp($type->name, "Eau de Toilette") == 0){
                $longevity = 80;
                $fragrance_type_weight->condition = "Eau de Toilette";
                }
                else if(strcmp($type->name, "Eau de Cologne") == 0){
                $longevity = 70;
                $fragrance_type_weight->condition = "Eau de Cologne";
                }
                else if(strcmp($type->name, "Eau Fraiche") == 0){
                $longevity = 60;
                $fragrance_type_weight->condition = "Eau Fraiche";
                }
                else{
                $longevity = 80;
                $fragrance_type_weight->condition = "Attar";
                }
                $fragrance_type_weight->weight = $longevity;
                
                // Humidity: Makes you sweat more.
                $humidity_weight = (object) [
                'condition' => NULL,
                'weight'    => NULL
                ];
                if($avg_hum > 70){
                $frag_profile->sweat *= 1.3;
                $humidity_weight->condition = 70;
                $humidity_weight->weight = 1.3;
                }
                else if($avg_hum > 55){
                $frag_profile->sweat *= 1.2;
                $humidity_weight->condition = 55;
                $humidity_weight->weight = 1.2;
                }

                // Heat: Volatilizes essences faster.
                $sustainability_heat_weight = (object) [
                'condition' => NULL,
                'weight'    => NULL
                ];
                if($avg_temp > 82){  
                $sustainability *= 0.8;
                $sustainability_heat_weight->condition = 82;
                $sustainability_heat_weight->weight = 0.8;
                }
                else if($avg_temp > 71.9){
                $sustainability *= 0.9;
                $sustainability_heat_weight->condition = 71.9;
                $sustainability_heat_weight->weight = 0.9;
                }

                // Weather: Cold weather/region holds stronger, lusher floral notes in check, which is why your tropical perfumes will smell all wrong during winter or autumn. Conversely, lighter scents work better in summer and spring.
                $warm_cold_weight = (object) [
                'condition_1' => NULL,
                'condition_2' => NULL,
                'weight'      => NULL
                ];
                if($avg_temp > 65){
                if( in_array("Floral", $accords) ){              
                    $suitability *= 1.1;
                    $warm_cold_weight->condition_1 = 65;
                    $warm_cold_weight->condition_2 = "Floral";
                    $warm_cold_weight->weight      = 1.1;
                }
                }
                else{
                if( in_array("Tropical", $accords) ){
                    $suitability *= 1.1;
                    $warm_cold_weight->condition_1 = NULL;
                    $warm_cold_weight->condition_2 = "Tropical";
                    $warm_cold_weight->weight      = 1.1;
                }
                }

                // Sweat: Increases the strength of warm fragrances.
                $sweat_weight = (object) [
                'condition_1' => NULL,
                'condition_2' => NULL,
                'weight'      => NULL
                ];
                if($frag_profile->sweat > 50){
                $sustainability *= 0.95;
                $sweat_weight->condition_1 = 0.95;
                
                if(in_array("Warm", $accords)){
                    $strength_of_fragrance *= 1.15;

                    $sweat_weight->condition_2 = "Warm";
                    $sweat_weight->weight = 1.15;
                }
                }
                
                // BMI:
                // Multiply your weight in pounds by 703, Divide this number by your height in inches, Divide again by your height in inches.
                // $bmi = ($frag_profile->weight*2.205)/pow($frag_profile->height,2);
                // Google:
                // Body Mass Index is a simple calculation using a person's height and weight. The formula is BMI = kg/m2
                // where kg is a person's weight in kilograms and m2 is their height in metres squared. A BMI of 25.0 or more is overweight, while the healthy range is 18.5 to 24.9.
                $bmi = ($frag_profile->weight)/pow($frag_profile->height/39.37,2);

                // A BMI (Body Mass Index) under 18 is slim, 20 to 25 is normal, 25 to 30 is overweight, and greater than 30 is obese.
                // Higher bmi requires more scent.
                $bmi_weight = (object) [
                'condition' => NULL,
                'weight'    => NULL
                ];
                if($bmi > 30){
                $strength_of_fragrance *= 0.8;
                $bmi_weight->condition = 30;
                $bmi_weight->weight = 0.8;
                }
                else if($bmi > 25){
                $strength_of_fragrance *= 0.9;
                $bmi_weight->condition = 25;
                $bmi_weight->weight = 0.9;
                }
                else if($bmi < 19){
                $strength_of_fragrance *= 1.1;
                $bmi_weight->condition = 19;
                $bmi_weight->weight = 1.1;
                }

                // Sillage
                if($fragrance->avg_hum == 0){
                $sillage->value =  10;
                }
                else{
                $sillage->value = ( (($strength_of_fragrance*10) / $fragrance->avg_hum) + ($fragrance->sillage / $fragrance->avg_hum) ) / 2;
                $sillage->value = $sillage->value * $avg_hum;
                }
                if($sillage->value>100){
                $sillage->value = 100;
                }
                // var_dump($strength_of_fragrance, $fragrance->avg_hum, $fragrance->sillage, $avg_hum);return;
            
                // Dryness of Skin: If you have dry skin, your fragrance will never be able to last as long as you want it to.
                // The reason? There’s nothing for the fragrance to hang on to, thus making it evaporate even faster.
                $skin_weight = (object) [
                'condition' => NULL,
                'weight'    => NULL
                ];
                if(strcmp($frag_profile->skin, "Very Oily") == 0){
                $longevity *= 1.2;
                $skin_weight->condition = "Very Oily";
                $skin_weight->weight = 1.2;
                }
                else if(strcmp($frag_profile->skin, "Oily") == 0){
                $longevity *= 1.1;
                $skin_weight->condition = "Oily";
                $skin_weight->weight = 1.1;
                }
                else if(strcmp($frag_profile->skin, "Dry & Moisturized") == 0){
                $longevity *= 0.9;
                $skin_weight->condition = "Dry & Moisturized";
                $skin_weight->weight = 0.9;
                }
                else{
                $longevity *= 0.8;
                $skin_weight->condition = NULL;
                $skin_weight->weight = 0.8;
                }
            }
            else{
                // Create two more accounts on the weather website and adjust this controller with more apis.
            }

            // To save the weights to improve the model.
            $weights = (object) [
                'avg_temp'                    => $avg_temp,
                'avg_hum'                     => $avg_hum,
                'bmi'                         => $bmi,
                'fragrance_type_weight'       => $fragrance_type_weight,
                'humidity_weight'             => $humidity_weight,
                'sustainability_heat_weight'  => $sustainability_heat_weight,
                'warm_cold_weight'            => $warm_cold_weight,
                'sweat_weight'                => $sweat_weight,
                'bmi_weight'                  => $bmi_weight,
                'skin_weight'                 => $skin_weight
            ];

            $weights =  json_encode($weights);
            }
        }
        else{
        // $logged_in = FALSE;
        $user_gender = $weights = $longevity = $suitability = $sustainability = NULL;
        }

        return view('store.fragrance',[
            'user_gender'       => $user_gender,
            'fragrance'         => $fragrance,
            'type'              => $type,
            'sillage'           => $sillage,
            'accords'           => $accords,
            'notes'             => $notes,
            'allow_edit'        => $allow_edit,
            'longevity'         => $longevity,
            'suitability'       => $suitability,
            'sustainability'    => $sustainability,
            'weights'           => $weights,
        ]);
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