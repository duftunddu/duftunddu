<?php

namespace App\Http\Controllers;

// For Fragrance
use App\Fragrance_Accord;
use App\Fragrance_Ingredient;
use App\Fragrance_Profile;

use App\Store;
use App\Store_Stock;
use App\User_Fragrance_Review;

use App\Accord;
use App\Ingredient;
use App\Location;

use App\Fragrance_Type;
use App\Brand_Tier;
use App\Fragrance;
use App\Fragrance_Brand;
use App\Fragrance_Brand_Availability;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Unavailable_Brands_Fragrances_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        
        // Brands
        $brands = Store_Stock::whereNull('fragrance_brand_id')
        ->get()
        ->pluck('fragrance_brand_name');
        $brands = $brands->merge(User_Fragrance_Review::whereNull('fragrance_brand_id')
        ->get()
        ->pluck('fragrance_brand_name'));

        // Fragrances
        $fragrances = Store_Stock::whereNull('fragrance_id')
        ->get()
        ->pluck('fragrance_name');
        $fragrances = $fragrances->merge(User_Fragrance_Review::whereNull('fragrance_id')
        ->get()
        ->pluck('fragrance_name'));


        // Get only unique values with in descending order of their appearance.
        $brands = $brands->toArray();
        $fragrances = $fragrances->toArray();

        $brands = array_count_values($brands);
        $fragrances = array_count_values($fragrances);

        arsort($brands);
        arsort($fragrances);

        $brands = array_keys($brands);
        $fragrances = array_keys($fragrances);

        // var_dump($fragrances);return;

        return view('admin.unavailable_brands_fragrances_panel',[
            'brands'        =>  $brands,
            'fragrances'   =>  $fragrances,
        ]);
    }
    

    // Add Brand
    public function add_brand_view($brand_name)
    {
       $tiers     =  Brand_Tier::all();
 
       $countries = DB::table('country_and_city')
       ->select('country_name')
       ->distinct()
       ->get();
 
       return view('moderator.brand_entry',[
           'brand_name'      =>    $brand_name,
           'tiers'           =>    $tiers,
           'countries'       =>    $countries
       ]);
    }

    public function store_brand(Request $request)
    {
        $validatedData = $request->validate([
            'name'            => 'required|unique:fragrance_brand',
            'tier_id'         => 'required',
            'location_id'     => 'required',
            'availability'    => 'required',
        ]);
            
        
        // To use in search engine
        $normal_name = Helper::remove_accents($request->input('name'));


        // Extracting ids of country names
        $location_id = Location::where('country_name', $request->input('location_id'))->first()->id;
        $availability_id = Location::where('country_name', $request->input('availability'))->first()->id;
        $availabilities_id = [];
        if ($request->availabilities) {
            for ($i = 0; $i < count($request->availabilities); $i++) {
                $availabilities_id[$i] = Location::where('country_name', $request->input('availabilities')[$i])->first()->id;
            }
        }
 

        // Storing
        DB::transaction(function () use ($request, &$brand_id, $normal_name, $location_id, $availability_id, $availabilities_id) {
          
            $new                    = new Fragrance_Brand();
            $new->name              = $request->input('name');
            $new->normal_name       = $normal_name;
            $new->tier_id           = $request->input('tier_id');
            $new->origin_id         = $location_id;
            $new->created_by        = request()->user()->id;
            $new->updated_by        = request()->user()->id;
    
            $new->discontinued      = '0';
            
            $new->save();
    
            // Availability, Store_Stock & User_Fragrance_Review
            $brand_id               = $new->id;
    
            $new                    = new Fragrance_Brand_Availability();
            $new->brand_id          = $brand_id;
            $new->location_id       = $availability_id;
    
            $new->save();
    
            if ($request->availabilities) {
                
                for ($i = 0; $i < count($request->availabilities); $i++) {
    
                    $new                 = new Fragrance_Brand_Availability();
                    $new->brand_id       = $brand_id;
                    $new->location_id    = $availabilities_id[$i];
    
                    $new->save();
                }
            }
        });

 
        // Adding ids to stock and fragrance reviews
        Store_Stock::whereNull('fragrance_brand_id')
        ->where('fragrance_brand_name', $request->input('name'))
        ->orWhere('fragrance_brand_name', $normal_name)
        ->update(['fragrance_brand_id' => $brand_id]);
       
        User_Fragrance_Review::whereNull('fragrance_brand_id')
        ->where('fragrance_brand_name', $request->input('name'))
        ->orWhere('fragrance_brand_name', $normal_name)
        ->update(['fragrance_brand_id' => $brand_id]);
       

        // Return
        return redirect('')->with('success',"{$request->input('name')} Added Successfully.");
    }
 

    // Add Fragrance
    public function add_fragrance_view($fragrance_name)
    {
        $brands         =   Fragrance_Brand::all();
        $types          =   Fragrance_Type::all();
        $accords        =   Accord::all();
        $ingredients    =   Ingredient::all();
        
        $currencies     =   Helper::currencies();
        
        return view('moderator.fragrance_entry',[
          'fragrance_name'      =>      $fragrance_name,
          'brands'              =>      $brands,
          'types'               =>      $types,
          'accords'             =>      $accords,
          'ingredients'         =>      $ingredients,
          'currencies'          =>      $currencies
        ]);
    }
 
    public function store_fragrance(Request $request)
    {
        $validatedData = $request->validate([
            'name'                 => 'required|unique:fragrance',
            'brand_id'             => 'required',
            'type_id'              => 'required',
            'gender'               => 'required',
            
            'accord_id'            => 'required',
            'ingredient_id'        => 'required',
        ]);
            
        // If currency exists without cost or vice versa
        // if($request->cost xor $request->currency) {
        //     return redirect()->back()->with('error','Currency & Cost should both be present.');
        // }
        
        $normal_name = Helper::remove_accents($request->input('name'));
        
        DB::transaction(function () use ($request, &$fragrance_id, $normal_name) {
        
            $new                            = new Fragrance();
            $new->brand_id                  = $request->input('brand_id');
            $new->name                      = $request->input('name');
            $new->normal_name               = $normal_name;
            $new->type_id                   = $request->input('type_id');
            $new->gender                    = $request->input('gender');
            // $new->cost                      = $request->input('cost');
            // $new->currency                  = $request->input('currency');
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


        // Adding ids to stock and fragrance reviews
        Store_Stock::whereNull('fragrance_id')
        ->where('fragrance_name', $request->input('name'))
        ->orWhere('fragrance_name', $normal_name)
        ->update(['fragrance_id' => $fragrance_id]);
       
        User_Fragrance_Review::whereNull('fragrance_id')
        ->where('fragrance_name', $request->input('name'))
        ->orWhere('fragrance_name', $normal_name)
        ->update(['fragrance_id' => $fragrance_id]);
       

    
        // $flight = Flight::find(1);
        // $review = User_Fragrance_Review::where('')
        //             ->first();

        // $flight->name = 'New Flight Name';

        // $flight->save();
    
        // Return
        return redirect('/unavailable_brands_fragrances_panel')->with('success','Fragrance added successfully.');
    }
}