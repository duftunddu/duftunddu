<?php

namespace App\Http\Controllers;

// For Fragrance
use App\Fragrance_Type;
use App\Brand_Ambassador_Profile;

use App\Fragrance;
use App\Fragrance_Brand;

use App\Profession;
use App\Skin_Type;
use App\Climate;
use App\Season;

use App\Store;
use App\Store_Stock;
use App\Store_Customer_Feature_Log;

use App\User_Fragrance_Review;

use Validator;
use Illuminate\Validation\Rule;

use App\Helper\Helper;
use App\Helper\Store_Helper;

use App\Helper\Fragrance_Review_Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Store_Controller extends Controller
{

    public function __construct() {
        // 
    }


    // Register
    public function index() {
        return view('forms.store_register');
    }


    // Home
    public function home() {
        if(!request()->user()->hasRole('store_owner')) {
            return redirect('/services_register');
        }
        
        $store_helper       = new Store_Helper();
        $fragrance_count    = $store_helper->get_store_stock_names('store')->count();

        return view('store.home',[
            'fragrance_count'   =>  $fragrance_count,
        ]);
    }


    // Call
    public function call() {
        return redirect('/store_profile/store');
    }


    // Profile
    public function add_profile($store_type)
    {
        $helper = new Helper();

        if($helper->is_stock_empty($store_type)){
            if(strcmp($store_type, "store") == 0){
                return redirect('/store_home')->with('error', 'Stock is empty. Add Fragrances to Stock first.');
            }
            // else{
            //     return 'Stock Empty. Add fragrances from Webstore Home first';
            // }
        }

        $professions    =   Profession::select('name')->get();
        $skin_types     =   Skin_Type::select('name')->get();
        $climates       =   Climate::select('name')->get();
        $seasons        =   Season::select('name')->get();
        
        
        return view('store.profile_entry',[
            'store_type'        =>    $store_type,
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
        ]);
    }

    public function store_profile(Request $request)
    {
        // Validation
        $this->validate(
            $request, [
            'gender'            =>  ['required', Rule::in(['Male', 'Female','Other'])],
            'dob'               => 'required',
            'profession'        => 'required|exists:profession,name',
            'skin_type'         => 'required|exists:skin_type,name',
            'sweat'             => 'required',
            'climate'           => 'required|exists:climate,name',
            'season'            => 'required|exists:season,name',
            ],
            
            $messages = [
                'gender.in'             => 'The :attribute is invalid. Please select one from the list.',
                'profession.exists'     => 'The :attribute is invalid. Please select one from the list.',
                'skin_type.exists'      => 'The :attribute is invalid. Please select one from the list.',
                'climate.exists'        => 'The :attribute is invalid. Please select one from the list.',
                'season.exists'         => 'The :attribute is invalid. Please select one from the list.',
        ]);
        
        $valid = false;
        $height_unit = '';
        $validator = Validator::make([], []);
        if( is_null($request->height_cent) && is_null($request->height_feet) && is_null($request->height_inches) ){
            $valid = false;
            $validator->getMessageBag()->add('height_cent',     'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_inches',   'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_feet',   "");
        }
        else 
        if( !is_null($request->height_cent) ){
            if( (is_null($request->height_feet) && is_null($request->height_inches)) ){
                $height_unit = 'cent';
                $valid = true;
            }
            else{
                $valid = false;
                $validator->getMessageBag()->add('height_cent',     'Enter height either in feet & inches or centimeters. Not in both.');
                $validator->getMessageBag()->add('height_inches',   'Enter height either in feet & inches or centimeters. Not in both.');
                $validator->getMessageBag()->add('height_feet',   "");
            }
        }
        else{
            if( (!is_null($request->height_feet) && !is_null($request->height_inches)) ){
                $height_unit = 'feet';
                $valid = true;
            }
            else if( is_null($request->height_feet) ){
                $valid = false;
                $validator->getMessageBag()->add('height_feet', 'Inches are required with Feet.');
            }
            else if( is_null($request->height_inches) ){
                $valid = false;
                $validator->getMessageBag()->add('height_inches', 'Feet is required with inches. Put zero if zero inches.');
            }
        }
        
        if (!$valid ) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $valid = false;
        $weight_unit = '';
        $validator = Validator::make([], []);
        if( is_null($request->kgs) && is_null($request->lbs) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',  'Enter weight either in kgs or pounds.');
            $validator->getMessageBag()->add('lbs',  'Enter weight either in kgs or pounds.');
        }
        else if( (!is_null($request->kgs) && !is_null($request->lbs)) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',   'Enter weight either in kgs or pounds. Not in both.');
            $validator->getMessageBag()->add('lbs',   'Enter weight either in kgs or pounds. Not in both.');
        }
        else if( is_null($request->kgs) ){
            $valid = true;
            $weight_unit = 'lbs';
        }
        else{
            $valid = true;
            $weight_unit = 'kgs';
        }

        if (!$valid ) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Validation ends

        
        // Units reslove
        $height = 0;
        if($height_unit == 'cent'){
            $height = $request->input('height_cent');
        }
        else{
            $height = $request->input('height_feet') * 12 + $request->input('height_inches');
        }

        $weight = 0;
        if($weight_unit == 'kgs'){
            $weight = $request->input('kgs');
        }
        else{
            $weight = $request->input('lbs') * 2.205;
        }


        // Fetch Data
        $profession_id = Profession::where('name', $request->input('profession'))->pluck('id')->first();
        $skin_type_id  = Skin_type::where('name', $request->input('skin_type'))->pluck('id')->first();
        $climate_id    = Climate::where('name', $request->input('climate'))->pluck('id')->first();
        $season_id     = Season::where('name', $request->input('season'))->pluck('id')->first();

        $location = new Helper();
        $location = $location->get_current_location();

        $store_profile = (object) [
            'gender'            =>      $request->input('gender'),
            'dob'               =>      $request->input('dob'),
            'profession'        =>      $request->input('profession'),
            'skin_type'         =>      $request->input('skin_type'),
            'sweat'             =>      $request->input('sweat'),
            'height'            =>      $height,
            'weight'            =>      $weight,
            'climate'           =>      $request->input('climate'),
            'season'            =>      $request->input('season'),
            'location_id'       =>      $location->id,
        ];

        // Storing the profile
        session([$request->input('store_type').'_profile'=> $store_profile]);

        DB::transaction(function () use (
            $request, $height, $weight,
            $profession_id, $skin_type_id, $climate_id, $season_id) {
            
            $new                        =       new Store_Customer_Feature_Log();
            
            $new->gender                =       $request->input('gender');
            $new->dob                   =       $request->input('dob');
            $new->profession_id         =       $profession_id;
            $new->skin_type_id          =       $skin_type_id;
            $new->sweat                 =       $request->input('sweat');
            $new->height                =       $height;
            $new->weight                =       $weight;
            $new->climate_id            =       $climate_id;
            $new->season_id             =       $season_id;

            $new->save();
        });
        

        // Return
        if ( strcmp($request->input('store_type'), "store") == 0 ) {
            
            // Get first from stock
            $frag_id = Store_Stock::where('store_id', Store::where('users_id', request()->user()->id)->first()->id)
            ->where('available', TRUE)
            ->first()->id;

            return redirect('/'.$request->input('store_type').'_fragrance/'.$frag_id);
        }
        else{

            $arr = session('web_call_data');

            $wb_cont = new Webstore_Controller();
            
            // For dev
            // return $wb_cont->webstore_call_dev($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5]);

            return $wb_cont->webstore_call($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5]);
        }
        
    }


    // Show Fragrance Review
    public function show_fragrance($id)
    {
        if(Store_Controller::is_stock_empty('store')){
            return redirect('/store_home')->with('error', 'Stock is empty. Add Fragrances to Stock first.');
        }

        // Fragrance
        $fragrance = Fragrance::where('id', $id)->first();

        if(is_null($fragrance)){
            return redirect()->route('search');
        }

        $brand = Fragrance_Brand::where('id', $fragrance->brand_id)->first()->name;
        $type = Fragrance_Type::where('id', $fragrance->type_id)->first()->name;

        
        // Indoor Outdoor
        $projection = User_Fragrance_Review::where('fragrance_id', $id)->get()->pluck('projection');
        if(!$projection->isEmpty()){
            $projection = $projection->avg();
        }
        else{
            $projection = NULL;
        }


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

        
        // Profile
        $frag_profile = session('store_profile');
        // dd($frag_profile);
        $user_gender = $frag_profile->gender;
        
        $fragrance_review_helper = new Fragrance_Review_Helper(); 

        $sustainability = trim($fragrance_review_helper->get_sustainability($id));
        if($sustainability != -1){
            $sustainability *= 100;
        }
        
        $longevity = $fragrance_review_helper->get_longevity($id);

        $suitability = $fragrance_review_helper->get_suitability($id);

        return view('store.fragrance',[
            'user_gender'       =>  $user_gender,
            'fragrance'         =>  $fragrance,
            'brand'             =>  $brand,
            'type'              =>  $type,
            'projection'        =>  $projection,
            'accords'           =>  $accords,
            'notes'             =>  $notes,
            'longevity'         =>  $longevity,
            'suitability'       =>  $suitability,
            'sustainability'    =>  $sustainability,
        ]);
    }


    // Empty Stock
    public function is_stock_empty()
    {
        // If the stock is empty, don't let them go to profile.
        
        $frag_id = Store_Stock::where('store_id', Store::where('users_id', request()->user()->id)->where('store', TRUE)->first()->id)
        ->where('available', TRUE)
        ->exists();

        return !$frag_id;
        
        // if($frag_id) {
        //     // Empty
        //     return FALSE;
        // }
        // else {
        //     return TRUE;
        // }
    }

    public function empty_stock()
    {
        return redirect('/store_home');
    }


    // Stock Suitability
    public function stock_suitability()
    {
        $store_helper = new Store_Helper();
        $fragrances = $store_helper->get_store_stock_fragrances('store');

        $insufficient_data      =   $store_helper->data_is_insufficient('store');

        $fragrance_review_helper = new Fragrance_Review_Helper();
        
        for($i = 0 ; $i < $fragrances->count() ; $i++) {
            $fragrances[$i]->suitability = $fragrance_review_helper->get_suitability($fragrances[$i]->id);
            
            // For debugging
            // Helper::var_dump_readable($fragrances[$i]->suitability); return;
        }

        $fragrances->sortByDesc('suitability');

        return view('store.stock_suitability',[
            'fragrances'   =>  $fragrances,
            'insufficient_data'     =>  $insufficient_data,
        ]);
    }


    // Stock
    public function show_stock()
    {
        $stock = new Store_Helper();
        $stock = $stock->get_store_stock_names('store');
        
        return view('store.stock',[
            'stock'         =>  $stock,
        ]);
    }

    public function add_to_stock_view()
    {
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
        
        // $store_id = Store::find(request()->user()->id)->id;
        $store_helper = new Store_Helper();
        $store_id = $store_helper->get_store_id('store');

        // $store_id = Store::where('users_id', request()->user()->id)
        // ->where('request_status', 'approved')
        // ->where('store', '1')
        // ->first()->id;
        
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
        $store_helper = new Store_Helper();
        $store_id = $store_helper->get_store_id('store');

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
