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

use App\Helper\Fragrance_Review_Helper;
use App\Helper\Helper;
use Carbon\Carbon;

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
        
        $currencies     =   Helper::get_currencies();
        
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
        $currencies     = Helper::get_currencies();
        
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

        $normal_name = Helper::remove_accents($request->input('name'));

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
            'name'                 => 'required',
            'type_id'              => 'required',
            'gender'               => 'required',
            'sillage'              => 'required',
            'cost'                 => 'required',
            'currency'             => 'required',
            'accord_id'            => 'required',
            'ingredient_id'        => 'required',
        ]);

        $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();

        $normal_name = Helper::remove_accents($request->input('name'));
        
        // Average Humidity near Brand Ambassador
        $avg_hum= Helper::avg_hum(Fragrance_Profile::where('users_id', $ambassador->users_id)->first()->location_id);

        DB::transaction(function () use ($request, $ambassador, $normal_name, $avg_hum) {

        $new                            = new fragrance();
        $new->brand_id                  = $ambassador->brand_id;
        $new->name                      = $request->input('name');
        $new->normal_name               = $normal_name;
        $new->type_id                   = $request->input('type_id');
        $new->gender                    = $request->input('gender');
        $new->sillage                   = $request->input('sillage');
        $new->avg_hum                   = $avg_hum;
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

            $helper = new Helper();

            // Currency Convert
            if(isset($fragrance->cost) && isset($fragrance->currency)){
                $fragrance->cost = $helper->convert_currency(/*value*/ $fragrance->cost, /*from*/ $fragrance->currency, /*to*/ $frag_profile->currency);
                $fragrance->currency = $frag_profile->currency;   
            }

            // var_dump($weather_data_json->successful());return;
            if($helper->get_weather_success()){

                // Create this
                $fragrance_review_helper = new Fragrance_Review_Helper(); 

                $sustainability = trim($fragrance_review_helper->get_sustainability($id));
                if($sustainability != -1){
                    $sustainability *= 100;
                }
                
                $longevity = $fragrance_review_helper->get_longevity($id);

                $suitability = $fragrance_review_helper->get_suitability($id);

                // dd($longevity->sufficient);

                // $helper->var_dump_readable($longevity); return;
                // var_dump($longevity->value); return;

                //TODO: Create separate functions for each of the following, fetch weights in those functions from database.   
                
                // Humidity: Makes you sweat more.
                // $humidity_weight = (object) [
                // 'condition' => NULL,
                // 'weight'    => NULL
                // ];
                // if($avg_hum > 70){
                //     $frag_profile->sweat *= 1.3;
                //     $humidity_weight->condition = 70;
                //     $humidity_weight->weight = 1.3;
                // }
                // else if($avg_hum > 55){
                //     $frag_profile->sweat *= 1.2;
                //     $humidity_weight->condition = 55;
                //     $humidity_weight->weight = 1.2;
                // }
                // else if($avg_hum > 40){
                //     $frag_profile->sweat *= 1.1;
                //     $humidity_weight->condition = 40;
                //     $humidity_weight->weight = 1.1;
                // }

                // Weather: Cold weather/region holds stronger, lusher floral notes in check, which is why your tropical perfumes will smell all wrong during winter or autumn. Conversely, lighter scents work better in summer and spring.
                // $warm_cold_weight = (object) [
                //     'condition_1' => NULL,
                //     'condition_2' => NULL,
                //     'weight'      => NULL
                // ];
                // if($avg_temp > 65){
                //     if( in_array("Floral", $accords) ){              
                //         $suitability *= 1.2;
                //         $warm_cold_weight->condition_1 = 65;
                //         $warm_cold_weight->condition_2 = "Floral";
                //         $warm_cold_weight->weight      = 1.2;
                //     }
                // }
                // else{
                //     if( in_array("Tropical", $accords) ){
                //         $suitability *= 1.2;
                //         $warm_cold_weight->condition_1 = 65;
                //         $warm_cold_weight->condition_2 = "Tropical";
                //         $warm_cold_weight->weight      = 1.2;
                //     }
                // }

                // BMI:
                // Multiply your weight in pounds by 703, Divide this number by your height in inches, Divide again by your height in inches.
                // $bmi = ($frag_profile->weight*2.205)/pow($frag_profile->height,2);
                // Google:
                // Body Mass Index is a simple calculation using a person's height and weight. The formula is BMI = kg/m2
                // where kg is a person's weight in kilograms and m2 is their height in metres squared. A BMI of 25.0 or more is overweight, while the healthy range is 18.5 to 24.9.

                // A BMI (Body Mass Index) under 18 is slim, 20 to 25 is normal, 25 to 30 is overweight, and greater than 30 is obese.
                // Higher bmi requires more scent.
                
                // $bmi = ($frag_profile->weight)/pow($frag_profile->height/39.37,2);

                }
                else{
                    // Create two more accounts on the weather website and adjust this controller with more apis.
                }
            }
        }
        else{
            $user_gender = $weights = $longevity = $suitability = $sustainability = NULL;
        }

        return view('forms.fragrance',[
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