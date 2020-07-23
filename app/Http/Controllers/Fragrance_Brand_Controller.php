<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use App\Country;
use App\Brand_Tier;
use App\Fragrance_Brand;
use App\Fragrance_Brand_Availability;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fragrance_Brand_Controller extends Controller
{
    /**
  * Create a new controller instance.
  *
  * @return void
  */
 
  public function __construct()
  {
    
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
      
      // var_dump($tiers[0]);
      // return;

      return view('forms.brand_entry',[
         'tiers'        =>    $tiers,
         'countries'    =>    $countries
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

      DB::transaction(function () use ($request) {
         
         $new                    = new fragrance_brand();
         $new->name              = $request->input('name');

         $new->tier_id           = $request->input('tier_id');
         $new->origin_id         = $request->input('origin_id');
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
      return redirect('brand_entry');
   }

   public function output()
   {
      $fragrance_Brands = Fragrance_Brand::all();

      return view('forms.brand_output',[
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

   $tier = Brand_Tier::find($brand->tier_id);
   // var_dump($tier);
   // return;

   $origin = Country::find($brand->origin_id);

   $countries = DB::table('fragrance_brand_availability')
      ->join('countries', 'countries.id', '=', 'fragrance_brand_availability.country_id')
      ->where('fragrance_brand_availability.brand_id',$id)
      ->select('countries.name')
      ->get();

   return view('forms.brand_show',[
      'brand'     => $brand,
      'tier'      => $tier,
      'origin'      => $origin,
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
