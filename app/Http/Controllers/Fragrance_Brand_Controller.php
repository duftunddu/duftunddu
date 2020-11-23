<?php

namespace App\Http\Controllers;

use App\Location;
use App\Country_And_City;
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
      $tiers     =  Brand_Tier::all();
      
      $countries = DB::table('country_and_city')
         ->select('country_name')
         ->distinct()
         ->get();

      return view('admin.brand_entry',[
         'tiers'        =>    $tiers,
         'countries'    =>    $countries
      ]);
   }

   public function index_ba()
   {
      $ambassador = Brand_Ambassador_Request::where('users_id', request()->user()->id)->first();

      if ($ambassador->status == 'existing_brand_request'){
         return redirect('application_status');
      }

      $tiers     =  Brand_Tier::all();

      $countries = DB::table('country_and_city')
      ->select('country_name')
      ->distinct()
      ->get();

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
         'location_id'     => 'required',
         'availability'    => 'required',
       ]);

      // To use in search engine
      $normal_name = Helper::normalize_name($request->input('name'));

      // Extracting ids of country names
      $location_id = Location::where('country_name', $request->input('location_id'))->first()->id;
      $availability_id = Location::where('country_name', $request->input('availability'))->first()->id;
      $availabilities_id = [];
      if ($request->availabilities) {
         for ($i = 0; $i < count($request->availabilities); $i++) {
            $availabilities_id[$i] = Location::where('country_name', $request->input('availabilities')[$i])->first()->id;
         }
      }
      DB::transaction(function () use ($request, $normal_name, $location_id, $availability_id, $availabilities_id) {
         
         $new                    = new fragrance_brand();
         $new->name              = $request->input('name');
         $new->normal_name       = $normal_name;
         $new->tier_id           = $request->input('tier_id');
         $new->origin_id         = $location_id;
         $new->created_by        = request()->user()->id;
         $new->updated_by        = request()->user()->id;

         $new->discontinued      = '0';
         
         $new->save();

         // Availability
         $brand_id = $new->id;

         $new                 = new Fragrance_Brand_Availability();
         $new->brand_id       = $brand_id;
         $new->location_id    = $availability_id;

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

      $request->session()->reflash();
      
      // Return
      return redirect()->back()->with('success','Brand Added Successfully.');
   }

   public function store_ba(Request $request, $brand_name)
   {
      $validatedData = $request->validate([
          'tier_id'         => 'required',
          'location_id'     => 'required',
          'availability'    => 'required',
      ]);

      // To use in search engine
      $normal_name = Helper::normalize_name($brand_name);

      // Extracting ids of country names
      $location_id = Location::where('country_name', $request->input('location_id'))->first()->id;
      $availability_id = Location::where('country_name', $request->input('availability'))->first()->id;
      $availabilities_id = [];
      if ($request->availabilities) {
         for ($i = 0; $i < count($request->availabilities); $i++) {
            $availabilities_id[$i] = Location::where('country_name', $request->input('availabilities')[$i])->first()->id;
         }
      }

      DB::transaction(function () use ($request, $brand_name, $normal_name, $location_id, $availability_id, $availabilities_id) {

         $new                    = new Fragrance_Brand();
         $new->name              = $brand_name;
         $new->normal_name       = $normal_name;
         $new->tier_id           = $request->input('tier_id');
         $new->origin_id         = $location_id;
         $new->created_by        = request()->user()->id;
         $new->updated_by        = request()->user()->id;
         
         $new->discontinued      = '0';
         
         $new->save();
         
         // Availability
         $brand_id = $new->id;
         $new                 = new Fragrance_Brand_Availability();
         $new->brand_id       = $brand_id;
         $new->location_id    = $availability_id;
         $new->save();

         if ($request->availabilities) {
            for ($i = 0; $i < count($request->availabilities); $i++) {
            $new                 = new Fragrance_Brand_Availability();
            $new->brand_id       = $brand_id;
            $new->location_id    = $availabilities_id[$i];
            $new->save();
            }
         }

         $ambassador = Brand_Ambassador_Request::where('users_id', request()->user()->id)->first();
         $ambassador->brand_id = $brand_id;
         $ambassador->status = 'existing_brand_request';
         $ambassador->save();

      });

      $request->session()->reflash();
      
      // Return
      return redirect('application_status')->with('info','Brand added for verification.');
   }

   public function all_brands()
   {
      $brands = Fragrance_Brand::orderBy('name', 'asc')
         ->paginate(10);
      
      return view('forms.brands',[
         'brands'       => $brands,
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
      $brand = Fragrance_Brand::find($id);

      if(empty($brand)){
         return redirect()->route('search');
      }

      $tier = Brand_Tier::find($brand->tier_id);

      $origin = Location::find($brand->origin_id);

      $countries = DB::table('fragrance_brand_availability')
         ->join('location', 'location.id', '=', 'fragrance_brand_availability.location_id')
         ->where('fragrance_brand_availability.brand_id',$id)
         ->select('location.country_name')
         ->get();

      // All data in a single query, Availability list required thinking, I was tired.   
      // $data = DB::table('fragrance_brand')
      //    ->where('fragrance_brand.id',$id)
      //    ->join('brand_tier', 'brand_tier.id', '=', 'fragrance_brand.tier_id')
      //    ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', '=', 'fragrance_brand.id')
      //    ->join('location as origin', 'origin.id', '=', 'fragrance_brand.origin_id')
      //    ->join('location', 'location.id', '=', 'fragrance_brand_availability.location_id')
      //    ->where('fragrance_brand_availability.brand_id',$id)
      //    ->select('brand_tier.name as tier', 'origin.id as country_name', 'location.country_name as availablity')
      //    ->get();
         
      // Helper::var_dump_readable($data);return;

      return view('forms.brand',[
         'brand'     => $brand,
         'tier'      => $tier,
         'origin'    => $origin,
         'countries' => $countries->sortBy('name'),
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
