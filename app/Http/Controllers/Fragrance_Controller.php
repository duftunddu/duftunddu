<?php

namespace App\Http\Controllers;

use App\Location;
use App\Accord;
use App\Ingredient;
use App\Fragrance;
use App\Fragrance_Type;
use App\Fragrance_Brand;
use App\Fragrance_Accord;
use App\Fragrance_Ingredient;
use App\Fragrance_Profile;
use App\Brand_Ambassador_Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Helper\Helper;

class Fragrance_Controller extends Controller
{
  /**
    * Create a new controller instance.
    *
    * @return void
    */
    
  public function __construct()
  {
      //
  }

  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function index()
  {
      $types       = Fragrance_Type::all();
      $accords     = Accord::all();
      $ingredients = Ingredient::all();
      $brands      = Fragrance_Brand::all();
      
      $currencies     =   Helper::currencies();
      
      return view('admin.fragrance_entry',[
        'types'         => $types,
        'accords'       => $accords,
        'ingredients'   => $ingredients,
        'brands'        => $brands,
        'currencies'    => $currencies
        ]);
  }

  public function index_ba()
  {
    $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();

    $brand = Fragrance_Brand::find($ambassador->brand_id);
    
    $types          = Fragrance_Type::all();
    $accords        = Accord::all();
    $ingredients    = Ingredient::all();
    $currencies     = Helper::currencies();
    
    return view('brand_ambassador.fragrance_entry',[
      'brand'         => $brand,
      'types'         => $types,
      'accords'       => $accords,
      'ingredients'   => $ingredients,
      
      'currencies'    => $currencies
    ]);
  }

  /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function create()
  {
    //
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
      $validatedData = $request->validate([
        'name'                 => 'required|unique:fragrance',
        'brand_id'             => 'required',
        'type_id'              => 'required',
        'gender'               => 'required',
        'cost'                 => 'required',
        'currency'             => 'required',
        
        'accord_id'            => 'required',
        'ingredient_id'        => 'required',
      ]);

      $normal_name = Helper::normalize_name($request->input('name'));

      DB::transaction(function () use ($request, $normal_name) {

      $new                            = new fragrance();
      $new->brand_id                  = $request->input('brand_id');
      $new->name                      = $request->input('name');
      $new->normal_name               = $normal_name;
      $new->type_id                   = $request->input('type_id');
      $new->gender                    = $request->input('gender');
      $new->cost                      = $request->input('cost');
      $new->currency                  = $request->input('currency');
      $new->created_by                = request()->user()->id;

      $new->save();

      $fragrance_id = $new->id;
      
      // Accord
      $new               = new fragrance_accord();
      $new->fragrance_id = $fragrance_id;
      $new->accord_id    = $request->input('accord_id');
      $new->save();
      
      if ($request->accord_ids) {
        
        for ($i = 0; $i < count($request->accord_ids); $i++) {
          
          $new               = new fragrance_accord();
          $new->fragrance_id = $fragrance_id;
          $new->accord_id    = $request->input('accord_ids')[$i];

          $new->save();

        }
      }

      // Ingredient
        $new                  = new fragrance_ingredient();
        $new->fragrance_id    = $fragrance_id;
        $new->ingredient_id   = $request->input('ingredient_id');
        $new->note            = $request->input('note');
        $new->intensity       = $request->input('intensity');
        $new->save();

    
      if ($request->ingredient_ids) {

        
        for ($i = 0; $i < count($request->ingredient_ids); $i++) {
          
          $new                  = new fragrance_ingredient();
          $new->fragrance_id    = $fragrance_id;
          $new->ingredient_id   = $request->input('ingredient_ids')[$i];
          $new->note            = $request->input('notes')[$i];
          $new->intensity       = $request->input('intensities')[$i];
          
          $new->save();
        
        }
      }

    });

    $request->session()->reflash();

    // Return
    return redirect()->back()->with('success','Fragrance added successfully.');
  }

  public function store_ba(Request $request)
  {
      $validatedData = $request->validate([
        'name'                 => 'required|unique:fragrance',
        'type_id'              => 'required',
        'gender'               => 'required',
        'cost'                 => 'required',
        'currency'             => 'required',
        
        'accord_id'            => 'required',
        'ingredient_id'        => 'required',
      ]);

      $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();

      $normal_name = Helper::normalize_name($request->input('name'));

      DB::transaction(function () use ($request, $ambassador, $normal_name) {

      $new                            = new fragrance();
      $new->brand_id                  = $ambassador->brand_id;
      $new->name                      = $request->input('name');
      $new->normal_name               = $normal_name;
      $new->type_id                   = $request->input('type_id');
      $new->gender                    = $request->input('gender');
      $new->cost                      = $request->input('cost');
      $new->currency                  = $request->input('currency');
      $new->created_by                = request()->user()->id;

      $new->save();

      $fragrance_id = $new->id;
      
      // Accord
      $new               = new fragrance_accord();
      $new->fragrance_id = $fragrance_id;
      $new->accord_id    = $request->input('accord_id');
      $new->save();
      
      if ($request->accord_ids) {
        
        for ($i = 0; $i < count($request->accord_ids); $i++) {
          
          $new               = new fragrance_accord();
          $new->fragrance_id = $fragrance_id;
          $new->accord_id    = $request->input('accord_ids')[$i];

          $new->save();

        }
      }

      // Ingredient
        $new                  = new fragrance_ingredient();
        $new->fragrance_id    = $fragrance_id;
        $new->ingredient_id   = $request->input('ingredient_id');
        $new->note            = $request->input('note');
        $new->intensity       = $request->input('intensity');
        $new->save();

    
      if ($request->ingredient_ids) {

        
        for ($i = 0; $i < count($request->ingredient_ids); $i++) {
          
          $new                  = new fragrance_ingredient();
          $new->fragrance_id    = $fragrance_id;
          $new->ingredient_id   = $request->input('ingredient_ids')[$i];
          $new->note            = $request->input('notes')[$i];
          $new->intensity       = $request->input('intensities')[$i];
          
          $new->save();
        
        }
      }

    });

    $request->session()->reflash();

    // Return
    return redirect('ambassador_home')->with('success','Fragrance added successfully.');
  }

  public function all_fragrances_array($id)
  {
    $brand = Fragrance_Brand::find($id);

    $fragrances = Fragrance::where('brand_id', $brand->id)
      ->orderBy('name', 'asc')
      ->get(10);

    return $fragrances;
  }

  public function all_fragrances($id)
  {
    $brand = Fragrance_Brand::find($id);
    
    if(is_null($brand)){
      return redirect()->route('search');
    }

    $fragrances = Fragrance::where('brand_id', $brand->id)
      ->orderBy('name', 'asc')
      ->paginate(10);

    return view('forms.fragrances',[
        'brand'        => $brand,
        'fragrances'   => $fragrances
    ]);
  }

  /**
    * Display the specified resource.
    *
    * @param  \App\Fragrance  $fragrance
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
    $fragrance = Fragrance::find($id);

    if(is_null($fragrance)){
      return redirect()->route('search');
    }

    $type = Fragrance_Type::find($fragrance->type_id)->first();

    $accords = DB::table('fragrance_accord')
        ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        // ->where('fragrance_accord.id', $id)
        ->select('accord.name')
        ->pluck('name')
        ->toArray();
    
    $notes = DB::table('fragrance_ingredient')
        ->join('ingredient', 'ingredient.id', '=', 'fragrance_ingredient.ingredient_id')
        // ->where('fragrance_ingredient.id', $id)
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

        // If user, then calculate fragrance suitability, sustainability and longevity
        if(request()->user()->hasRole(['user', 'genie_user', 'premium_user'])){

          $frag_profile = DB::table('fragrance_profile')
            ->where('users_id', request()->user()->id)
            ->join('skin_type', 'skin_type.id', '=', 'fragrance_profile.skin_type_id')
            ->join('climate', 'climate.id', '=', 'fragrance_profile.climate_id')
            ->join('season', 'season.id', '=', 'fragrance_profile.season_id')
            ->select('fragrance_profile.currency', 'fragrance_profile.location_id', 'fragrance_profile.sweat', 'fragrance_profile.height', 'fragrance_profile.weight', 'skin_type.name as skin', 'climate.name as climate', 'season.name as season')
            ->first();
          
          if($fragrance->currency != $frag_profile->currency){

            $fragrance->cost = Helper::currency_convert($fragrance->cost, $fragrance->currency, $frag_profile->currency);
            $fragrance->currency = $frag_profile->currency;
          }


          $location = Location::find($frag_profile->location_id);
          
          // https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&exclude={part}&appid={API key}
          $weather_data_json  = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,hourly,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");
          
          // Helper::var_dump_readable($weather_data_json->successful());return;
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
              $longevity = 100;
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

            // Dryness of Skin: If you have dry skin, your fragrance will never be able to last as long as you want it to.
            // The reason? There’s nothing for the fragrance to hang on to, thus making it evaporate even faster.
            // $skin_weight = [1.2, 1.1, 0.9, 0.8];
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
      $weights = $longevity = $suitability = $sustainability = NULL;
    }

    return view('forms.fragrance',[
        'fragrance'         => $fragrance,
        'type'              => $type,
        'accords'           => $accords,
        'notes'             => $notes,
        'allow_edit'        => $allow_edit,
        'longevity'         => $longevity,
        'suitability'       => $suitability,
        'sustainability'    => $sustainability,
        'weights'           => $weights,
    ]);
  }
  
  public function factors_affecting_fragrance(Request $request){

}

  /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Fragrance  $fragrance
    * @return \Illuminate\Http\Response
    */
  public function edit(Fragrance $fragrance)
  {
    //
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Fragrance  $fragrance
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, Fragrance $fragrance)
  {
    //
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Fragrance  $fragrance
    * @return \Illuminate\Http\Response
    */
  public function destroy(Fragrance $fragrance)
  {
    //
  }
}