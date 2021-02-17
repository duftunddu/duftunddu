<?php

namespace App\Http\Controllers;

// For Fragrance
use App\Fragrance_Type;
use App\Brand_Ambassador_Profile;

use App\Fragrance;
use App\Fragrance_Brand;

use App\Store;
use App\Store_Stock;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Store_Controller extends Controller
{

    public function __construct() {
        // 
    }


    // Register
    public function index(){
        return view('forms.store_register');
    }


    // Home
    public function home(){
        if(!request()->user()->hasRole('store_owner')) {
            return redirect('/services_register');
        }
        
        // $no_of_f = Store::write the rest
        $no_of_f = 5;

        // $store_id = Store::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('store.home',[
            'no_of_f'   =>  $no_of_f,
        ]);
    }

    // Show Fragrance Review
    public function show_fragrance($id)
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
                $fragrance->cost = Helper::convert_currency($fragrance->cost, $fragrance->currency, $frag_profile->currency);
                $fragrance->currency = $frag_profile->currency;
            }

            $weather_data_json = Helper::get_weather_data($frag_profile->location_id);

            // var_dump($weather_data_json->successful());return;
            if(Helper::get_weather_success()){
            
                //TODO: Create separate functions for each of the following, fetch weights in those functions from database.   

                // Sum of Weekly Variables
                $sum_temp = 0;
                $sum_hum  = 0;

                for ($i = 0; $i < 8; $i++){
                    $sum_temp += $weather_data_json->daily[$i]->temp->day;
                    $sum_hum  += $weather_data_json->daily[$i]->humidity;
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
            // $weights = (object) [
            //     'avg_temp'                    => $avg_temp,
            //     'avg_hum'                     => $avg_hum,
            //     'bmi'                         => $bmi,
            //     'fragrance_type_weight'       => $fragrance_type_weight,
            //     'humidity_weight'             => $humidity_weight,
            //     'sustainability_heat_weight'  => $sustainability_heat_weight,
            //     'warm_cold_weight'            => $warm_cold_weight,
            //     'sweat_weight'                => $sweat_weight,
            //     'bmi_weight'                  => $bmi_weight,
            //     'skin_weight'                 => $skin_weight
            // ];

            // $weights =  json_encode($weights);
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
            // 'weights'           => $weights,
        ]);
    }


    // Stock Suitability
    public function stock_suitability(){
        // 
    }


    // Stock
    public function show_stock() {

        $stock = Store_Stock::where('store_id', Store::find(request()->user()->id)->id)
        ->where('available', TRUE)
        ->select('id', 'fragrance_brand_name', 'fragrance_name')
        ->orderBy('fragrance_brand_name')
        ->get();

        return view('store.stock',[
            'stock'         =>  $stock,
        ]);
    }

    public function add_to_stock_view() {
        $brands      = Fragrance_Brand::pluck('name');
        $fragrances  = Fragrance::pluck('name');
      
        return view('store.add_to_stock',[
            'brands'         => $brands,
            'fragrances'     => $fragrances,
        ]);
    }

    public function add_to_stock(Request $request)
    {
        $validatedData = $request->validate([ 
            'brand'             =>  'required',
            'fragrance'         =>  'required',
        ]);
      
        // Fetch brand and fragrnace ids if they exist
        $brand_id = NULL; $fragrance_id = NULL;
        $brand_id = Fragrance_Brand::where('name', $request->input('brand'))
            ->orWhere('normal_name', $request->input('brand'))
            ->pluck('id')
            ->first();

        if($brand_id){
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->where('brand_id', $brand_id)
            ->pluck('id')
            ->first();
        }
        else{
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->pluck('id')
            ->first();
        }
        
        $store_id = Store::find(request()->user()->id)->id;
        
        $stock = Store_Stock::where('store_id', $store_id)
            ->where('fragrance_brand_name', $request->input('brand'))
            ->where('fragrance_name', $request->input('fragrance'))
            ->first();

        // If it existed, make it available and return. Otherwise, save it.
        if($stock){
        
            // If it is already available, LET THEM KNOW
            if($stock->available){
                return redirect()->back()->with('info', "{$request->input('fragrance')} is already in your stock.");
            }

            $stock->available = TRUE;
            $stock->save();
        }
        else{
            // If it didn't exist in stock before, then save it.
            // Storing

            $normal_b_name = Helper::remove_accents($request->input('brand'));
            $normal_f_name = Helper::remove_accents($request->input('fragrance'));


            DB::transaction(function () use ($request, $brand_id, $fragrance_id, 
            $store_id, $normal_b_name, $normal_f_name) {

                $new                            =   new Store_Stock();
                
                $new->store_id                  =   $store_id;
                $new->fragrance_brand_name      =   $normal_b_name;
                $new->fragrance_name            =   $normal_f_name;

                if($brand_id){
                    $new->fragrance_brand_id    =   $brand_id;   
                }
                if($fragrance_id){
                    $new->fragrance_id          =   $fragrance_id;   
                }

                $new->available                 =   TRUE;
                $new->save();
            });
        }
        return redirect()->back()->with('success', "{$request->input('fragrance')} by {$request->input('brand')} is added to your stock.");
    }

    public function remove_from_stock($stock_id)
    {
        $store_id = Store::find(request()->user()->id)->id;
        $stock = Store_Stock::find($stock_id);
        
        // If stock_id doesn't exist or this is not the owner of the stock 
        if(!$stock or $stock->store_id != $store_id){
            return redirect()->back()->with('error', "Request is invalid.");
        }
        
        $stock->available = FALSE;
        $stock->save();

        return redirect()->back()->with('success', "{$stock->fragrance_name} is removed from your stock.");
    }
}
