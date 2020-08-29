<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\Country;
use App\Brand_Tier;
use App\Fragrance_Brand;
use App\Fragrance_Brand_Availability;
use App\Brand_Ambassador_Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helper\Helper;

class Fragrance_Brand_Controller extends Controller
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
      $tiers            =  Brand_Tier::all();
      $countries        =  Country::all();
      //   $continents      =  Continent:all();
 

      return view('admin.brand_entry',[
         'tiers'        =>    $tiers,
         'countries'    =>    $countries
      ]);
   }

   public function index_ba()
   {
      $user = request()->user()->id;
      $ambassador = Brand_Ambassador_Request::where('users_id', $user)->first();

      if ($ambassador->status == 2){
         return redirect('application_status');
      }

      $tiers            =  Brand_Tier::all();
      $countries        =  Country::all();
      //   $continents      =  Continent:all();

      return view('brand_ambassador.brand_entry',[
          'ambassador_id'   =>    $ambassador->id,
          'brand_name'      =>    $ambassador->brand_name,
          'tiers'           =>    $tiers,
          'countries'       =>    $countries
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
         'name'            => 'required|unique:fragrance_brand',
         'tier_id'         => 'required',
         'origin_id'       => 'required',
         'availability'    => 'required',
       ]);

      $normal_name = Helper::normalize_name($request->input('name'));

      DB::transaction(function () use ($request,$normal_name) {
         
         $new                    = new fragrance_brand();
         $new->name              = $request->input('name');
         $new->normal_name       = $normal_name;
         $new->tier_id           = $request->input('tier_id');
         $new->origin_id         = $request->input('origin_id');
         $new->created_by        = request()->user()->id;

         $new->discontinued      = '0';
         
         $new->save();

         // Availability
         $brand_id = $new->id;

         $new                 = new Fragrance_Brand_Availability();
         $new->brand_id       = $brand_id;
         $new->country_id     = $request->input('availability');

         $new->save();

         if ($request->availabilities) {
            
            for ($i = 0; $i < count($request->availabilities); $i++) {

               $new                 = new Fragrance_Brand_Availability();
               $new->brand_id       = $brand_id;
               $new->country_id     = $request->input("availabilities")[$i];

               $new->save();
         }
      }
  
      });

      $request->session()->reflash();
      
      // Return
      return redirect()->back()->with('success','Brand added successfully.');
   }

   public function store_ba(Request $request, $brand_name)
   {
      $validatedData = $request->validate([
          'tier_id'         => 'required',
          'origin_id'       => 'required',
          'availability'    => 'required',
      ]);

      $normal_name = Helper::normalize_name($brand_name);

      DB::transaction(function () use ($request, $brand_name, $normal_name) {

         $new                    = new fragrance_brand();
         $new->name              = $brand_name;
         $new->normal_name       = $normal_name;
         $new->tier_id           = $request->input('tier_id');
         $new->origin_id         = $request->input('origin_id');
         $new->created_by        = request()->user()->id;
         
         $new->discontinued      = '0';
         
         $new->save();
         
         // Availability
         $brand_id = $new->id;
         $new                 = new Fragrance_Brand_Availability();
         $new->brand_id       = $brand_id;
         $new->country_id     = $request->input('availability');
         $new->save();

         if ($request->availabilities) {
            for ($i = 0; $i < count($request->availabilities); $i++) {
            $new                 = new Fragrance_Brand_Availability();
            $new->brand_id       = $brand_id;
            $new->country_id     = $request->input("availabilities")[$i];
            $new->save();
            }
         }

         $ambassador = Brand_Ambassador_Request::where('users_id', request()->user()->id)->first();
         $ambassador->brand_id = $brand_id;
         $ambassador->status = '2';
         $ambassador->save();

      });

      // if (request()->user()->hasRole('new_brand_ambassador')){
      //     request()->user()->removeRole('new_brand_ambassador');
      //     request()->user()->assignRole('brand_ambassador');
      // }

      // DB::transaction(function () use ($request) {
         
      // });
      
      $request->session()->reflash();
      
      // Return
      return redirect('application_status')->with('info','Brand added for verification.');
   }

   public function output()
   {
      $fragrance_Brands = Fragrance_Brand::all();

      return view('forms.brands',[
         'fragrance_Brand' => $fragrance_Brands->sortBy('name')
      ]);

   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Fragrance_Brand  $fragrance_Brand
    * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      // Fragrance_Brand $fragrance_Brand
      $brand = Fragrance_Brand::find($id);

      if(empty($brand)){
         return redirect()->route('search');
      }

      $tier = Brand_Tier::find($brand->tier_id);

      $origin = Country::find($brand->origin_id);

      $countries = DB::table('fragrance_brand_availability')
         ->join('countries', 'countries.id', '=', 'fragrance_brand_availability.country_id')
         ->where('fragrance_brand_availability.brand_id',$id)
         ->select('countries.name')
         ->get();

      return view('forms.brand',[
         'brand'     => $brand,
         'tier'      => $tier,
         'origin'    => $origin,
         'countries' => $countries->sortBy('name')
         ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Fragrance_Brand  $fragrance_Brand
    * @return \Illuminate\Http\Response
   */
   public function edit(Fragrance_Brand $fragrance_Brand)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Fragrance_Brand  $fragrance_Brand
    * @return \Illuminate\Http\Response
   */
   public function update(Request $request, Fragrance_Brand $fragrance_Brand)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Fragrance_Brand  $fragrance_Brand
    * @return \Illuminate\Http\Response
    */
   public function destroy(Fragrance_Brand $fragrance_Brand)
   {
      //
   }
}
