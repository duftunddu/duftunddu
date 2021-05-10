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
use App\Helper\Store_Helper;
use App\Helper\Fragrance_Review_Helper;

use App\User_Fragrance_Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Webstore_Controller extends Controller
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
        // Only one webstore is allowed per person
        if(request()->user()->hasRole(['webstore_owner'])){
            return redirect('/services_register');
        }

        return view('forms.webstore_register');
    }

    // Home
    public function home(){
        if(!request()->user()->hasRole('webstore_owner')) {
            return redirect('/services_register');
        }

        $store_helper = new Store_Helper();
        $fragrance_count = $store_helper->get_store_stock_names('webstore')->count();

        $api_key = Store::where('users_id', request()->user()->id)
        ->where('webstore', 1)
        ->where('request_status', 'approved')
        ->first()->api_key;

        return view('webstore.home',[
            'fragrance_count'   =>  $fragrance_count,
            'api_key'           =>  $api_key,
        ]);
    }



    // Client
    public function webstore_client(){
        return view('webstore.client');
    }

    public function webstore_client_dev(){
        return view('webstore.client_dev');
    }

    //faster alternative to gethostbyaddr()
    private function gethost( $ip )
    {
        //Make sure the input is not going to do anything unexpected
        //IPs must be in the form x.x.x.x with each x as a number

        if( preg_match( '/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip ) )
        {
            $host = `host -s -W 1 $ip`;
            $host = ( $host ? end( explode( ' ', trim( trim( $host ), '.' ) ) ) : $ip );
            if( in_array( $host, Array( 'reached', 'record', '2(SERVFAIL)', '3(NXDOMAIN)' ) ) )
            {
                return sprintf( '(error fetching domain name for %s)', $ip );
            }
            else
            {
                return $host;
            }
        }
        else
        {
            return '(invalid IP address)';
        }
    }

    // Call
    public function webstore_call($api_key, $ip_address, $brand_name, $fragrance_name, $fragrance_type, $theme){
        // API Key Check
        // $api_key_check = Store::where('users_id', request()->user()->id)
        // ->where('webstore', TRUE)
        // ->where('request_status', 'approved')
        // ->where('api_key', $api_key)
        // ->exists();

        // Test these
        // if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        //     $origin = $_SERVER['HTTP_ORIGIN'];
        // }
        // else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        //     $origin = $_SERVER['HTTP_REFERER'];
        // } else {
        //     $origin = $_SERVER['REMOTE_ADDR'];
        // }

        // if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_REFERER'])
        //  return $_SERVER['HTTP_ORIGIN'].'  '.$_SERVER['HTTP_REFERER'];
        // else if(isset($_SERVER['HTTP_ORIGIN']))
        //  return $_SERVER['HTTP_ORIGIN'];

        // Working
        // return $_SERVER['HTTP_REFERER'];
    

        $api_key_check = Store::where('webstore', TRUE)
        ->where('request_status', 'approved')
        ->where('api_key', $api_key)
        ->exists();

        if(!$api_key_check){
            return "Error: API Key Mismatch";
        }


        // Hostname Check
        $api_host = Store::where('api_key', $api_key)->first();

        $api_host_check = FALSE;
        if( !is_null($api_host) ){
            
            $domain = parse_url($api_host->website);

            dd($_SERVER['HTTP_REFERER'], $domain['host']);

            // Checking substring, don't simplify it, it might not work
            if( stripos($_SERVER['HTTP_REFERER'], $domain['host']) !== false ){
                $api_host_check = TRUE;
            }
        }

        if(!$api_host_check){
            return "Error: API Host Mismatch. Please ensure that the hostname is available via reverse DNS. ";
        }

        // For debugging
        // session()->forget('webstore_profile');

        if(is_null(session('webstore_profile'))){
        // Add Profile
            $arr = [];
            $arr[0] = $api_key;
            $arr[1] = $ip_address;
            $arr[2] = $brand_name;
            $arr[3] = $fragrance_name;
            $arr[4] = $fragrance_type;
            $arr[5] = $theme;

            session([ 'web_call_data' => $arr ]);

            $st_controller = new Store_Controller();
            return $st_controller->add_profile('webstore');
        }
        else{
        // Show Fragrance

            return Webstore_Controller::show_fragrance($brand_name, $fragrance_name);            
        }
    }

    public function webstore_call_dev($api_key, $ip_address, $brand_name, $fragrance_name, $fragrance_type, $theme){

        // Gives host name
        // request()->getHost()
        
        // $hostname = gethostbynamel(request()->ip());

        // $hostname = shell_exec('nslookup ' . 'codepen.io');
        // $address = shell_exec('nslookup ' . '104.17.14.48');

        // Working
        // $address = gethostbynamel('duftunddu.com');
        // $hostname = gethostbyaddr($address[0]);
        // var_dump($address, $hostname);
        // return;


        // API Key Check
        // $api_key_check = Store::where('users_id', request()->user()->id)
        // ->where('webstore', TRUE)
        // ->where('request_status', 'approved')
        // ->where('api_key', $api_key)
        // ->exists();

        if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_REFERER'])
            return $_SERVER['HTTP_ORIGIN'].'  '.$_SERVER['HTTP_REFERER'];
        else if(isset($_SERVER['HTTP_ORIGIN']))
            return $_SERVER['HTTP_ORIGIN'];
        else if(isset($_SERVER['HTTP_REFERER']))
            return $_SERVER['HTTP_REFERER'];
        
        return $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'];
        return $_SERVER['HTTP_REFERER'];
        return Webstore_Controller::getUserIpAddr();

        $api_key_check = Store::where('webstore', TRUE)
        ->where('request_status', 'approved')
        ->where('api_key', $api_key)
        ->exists();


        // Hostname Check
        $api_host = Store::where('api_key', $api_key)->first();

        $api_host_check = FALSE;
        if( !is_null($api_host) ){
            
            $domain = parse_url($api_host->website);

            // dd($domain['host'], gethostbyaddr(request()->getHost()));

            // Checking substring
            if( stripos($domain['host'], gethostbyaddr(request()->getHost()) ) !== false ){
                $api_host_check = TRUE;
            }
        }

        if(!$api_host_check){
            return "API Host Mismatch. Please ensure that the hostname is available via reverse DNS. ";
        }

        // For debugging
        // session()->forget('webstore_profile');

        if(is_null(session('webstore_profile'))){
        // Add Profile
            $arr = [];
            $arr[0] = $api_key;
            $arr[1] = $ip_address;
            $arr[2] = $brand_name;
            $arr[3] = $fragrance_name;
            $arr[4] = $fragrance_type;
            $arr[5] = $theme;

            session([ 'web_call_data' => $arr ]);

            $st_controller = new Store_Controller();
            return $st_controller->add_profile('webstore');
        }
        else{
        // Show Fragrance

            return Webstore_Controller::show_fragrance($brand_name, $fragrance_name);            
        }
    }

    // Show Fragrance Review
    public function show_fragrance($brand_name, $fragrance_name)
    {
        $fragrance = Fragrance::where('name', $fragrance_name)
        ->orWhere('normal_name', $fragrance_name)
        ->first();

        $id = $fragrance->id;


        if(is_null($fragrance)){
            return 'Fragrance Not Found';
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
        $frag_profile = session('webstore_profile');
        
        $user_gender = $frag_profile->gender;
        
        $fragrance_review_helper = new Fragrance_Review_Helper(); 

        $sustainability = trim($fragrance_review_helper->get_sustainability($id));
        if($sustainability != -1){
            $sustainability *= 100;
        }
        
        $longevity = $fragrance_review_helper->get_longevity($id);

        $suitability = $fragrance_review_helper->get_suitability($id);

        return view('webstore.fragrance',[
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

    // Model

    public function test_model(){
        return view('webstore.client2');
    }

    public function webstore_client_css(){
        return view('webstore.webstore_client_css');
    }
    public function webstore_client_css_css(){
        return view('webstore.webstore_client_css.css');
    }


    public function webstore_client_js(){
        return view('webstore.webstore_client_js');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // $validatedData = $request->validate([ 
        //     'accord_familiy_id' => 'required',
        //     'name'              => 'required|unique:accord',
        // ]);

        // DB::transaction(function () use ($request) {

        //         $new                = new Accord();
        //         $new->name          = $request->input('accord_familiy_id');
        //         $new->name          = $request->input('name');
        //         $new->created_by    = request()->user()->id;
        //         $new->save();
        // });

        // return redirect('/accord_entry')->with('success', 'Accord added successfully.');
    }

    // Profile
    public function add_profile()
    {
        $helper = new Helper();

        if($helper->is_stock_empty('webstore')){
            return redirect('/store_home')->with('error', 'Stock is empty. Add Fragrances to Stock first.');
        }

        $professions    =   Profession::select('name')->get();
        $skin_types     =   Skin_Type::select('name')->get();
        $climates       =   Climate::select('name')->get();
        $seasons        =   Season::select('name')->get();
        
        // $profile        =   session('store_profile');

        return view('store.profile_entry',[
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
            // 'profile'           =>    $profile,
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

        session(['store_profile'=> $store_profile]);

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
        
        // Get first from stock
        $frag_id = Store_Stock::where('store_id', Store::where('users_id', request()->user()->id)->first()->id)
        ->where('available', TRUE)
        ->first()->id;

        // Return
        return redirect('/store_fragrance/'.$frag_id);
    }



    // Empty Stock
    public function empty_stock()
    {
        return redirect('/store_home');
    }

    // Stock Suitability
    public function stock_suitability()
    {
        $store_helper           =    new Store_Helper();
        $fragrances             =    $store_helper->get_store_stock_fragrances('webstore');

        $store_stock_count      =    $store_helper->get_store_stock_count('webstore');

        // Checking whether insufficient data
        // $insufficient_data      =   FALSE;
        // if( $store_stock_count > $fragrances->count() ){
            // $insufficient_data  =   TRUE;
        // }

        $insufficient_data      =   $store_helper->data_is_insufficient('webstore');


        $fragrance_review_helper = new Fragrance_Review_Helper();
        
        for($i = 0 ; $i < $fragrances->count() ; $i++) {
            $fragrances[$i]->suitability = $fragrance_review_helper->get_suitability($fragrances[$i]->id);
            
            // For debugging
            // Helper::var_dump_readable($fragrances[$i]->suitability); return;
        }

        $fragrances->sortByDesc('suitability');

        return view('webstore.stock_suitability',[
            'fragrances'            =>  $fragrances,
            'insufficient_data'     =>  $insufficient_data,
        ]);
    }


    // Stock
    public function show_stock()
    {
        $stock = new Store_Helper();
        $stock = $stock->get_store_stock_names('webstore');
        
        return view('webstore.stock',[
            'stock'         =>  $stock,
        ]);
    }

    public function add_to_stock_view()
    {
        $brands      = Fragrance_Brand::pluck('name');
        $fragrances  = Fragrance::pluck('name');
      
        return view('webstore.add_to_stock',[
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
        $store_id = $store_helper->get_store_id('webstore');
        
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
        $store_id = $store_helper->get_store_id('webstore');

        $stock = Store_Stock::find($stock_id);
        
        // If stock_id doesn't exist or this is not the owner of the stock 
        if(!$stock or $stock->store_id != $store_id){
            return redirect()->back()->with('error', "Request is invalid.");
        }
        
        $stock->available = FALSE;
        $stock->save();

        return redirect()->back()->with('success', "{$stock->fragrance_name} is removed from your stock.");
    }



    // To get the domain the call is coming from
    // $_SERVER['HTTP_REFERER']
}