<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Ingredient;

use App\Fragrance_Brand;
use App\Fragrance;
use App\Fragrance_Profile;

use App\Perceiver;
use App\Perceiver_Accord;
use App\Perceived_Composition;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Perceiver_Controller extends Controller
{

  /**
      * Create a new controller instance.
      *
      * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }
    
  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function index($profile_id)
  {
      $accords     = accord::all();
      $ingredients = ingredient::all();
      $brands      = fragrance_brand::all();
      $fragrances  = fragrance::all();

      return view('forms.perceiver_fragrance',[
        'accords'       => $accords,
        'ingredients'   => $ingredients,
        'brands'        => $brands,
        'fragrances'    => $fragrances,
        'profile_id'    => $profile_id
        ]);

  }

  public function output()
  {
    $accords     = accord::all();
    $ingredients = ingredient::all();
    $brands      = fragrance_brand::all();
    return view('forms.assistant_input')
    ->with('accords', $accords)
    ->with('ingredients', $ingredients)
    ->with('brands', $brands);
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
  public function store(Request $request, $profile_id)
  {
      // $validatedData = $request->validate([
      //   'name'                 => 'required|unique:fragrance',
      //   'brand_id'             => 'required',
      //   'type'                 => 'required',
      //   'gender'               => 'required',
        
      //   'accord_id'            => 'required',
      //   'ingredient_id'        => 'required',
      // ]);

      $profile      = DB::table('fragrance_profile')->find($profile_id);

      // check account invasion
      if($profile->users_id != request()->user()->id){
        return redirect('home');
      }

      // Profile Details
      DB::transaction(function () use ($request, $profile) {

      $new                = new Perceiver();
      
      $fragrance_id = $request->input('fragrance_id');
      
      $new->fragrance_id    = $fragrance_id;
      $new->profile_id      = $profile->id;
      $new->gender          = $profile->gender;
      $new->dob             = $profile->dob;
      $date                 = Carbon::parse($profile->dob);

      $new->age             = Carbon::now()->diffInYears($date);
      $new->profession_id   = $profile->profession_id;
      $new->skin_type_id    = $profile->skin_type_id;
      $new->sweat           = $profile->sweat;
      $new->height          = $profile->height;
      $new->weight          = $profile->weight;
      $new->country_id      = $profile->country_id;
      $new->city_id         = $profile->city_id;
      $new->climate_id      = $profile->climate_id;
      $new->season_id       = $profile->season_id;
      $new->comment         = $request->input('comment');
      $new->like            = $request->input('like');

      $new->save();
      
      $perceiver_id = $new->id;
      
      // Accord
      $new               = new Perceiver_Accord();
      $new->perceiver_id = $perceiver_id;
      $new->accord_id    = $request->input('accord_id');
      $new->save();
      
      if ($request->accord_ids) {

        for ($i = 0; $i < count($request->accord_ids); $i++) {
          
          $new               = new Perceiver_Accord();
          $new->perceiver_id = $perceiver_id;
          $new->accord_id    = $request->input('accord_ids')[$i];

          $new->save();

        }
      }

      // Ingredient
      $new                  = new Perceived_Composition();
      $new->perceiver_id    = $perceiver_id;
      $new->ingredient_id   = $request->input('ingredient_id');
      $new->note            = $request->input('note');
      $new->intensity       = $request->input('intensity');
      $new->save();


      if ($request->ingredient_ids) {

        for ($i = 0; $i < count($request->ingredient_ids); $i++) {
          
          $new                  = new Perceived_Composition();
          $new->perceiver_id    = $perceiver_id;
          $new->ingredient_id   = $request->input('ingredient_ids')[$i];
          $new->note            = $request->input('notes')[$i];
          $new->intensity       = $request->input('intensities')[$i];
          
          $new->save();
        
        }
      }

    });

    $request->session()->reflash();

    // Return
    return redirect('home');

  }

  /**
    * Display the specified resource.
    *
    * @param  \App\Perceiver  $perceiver
    * @return \Illuminate\Http\Response
    */
  public function show(Perceiver $perceiver)
  {
    //
  }

  /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Perceiver  $perceiver
    * @return \Illuminate\Http\Response
    */
  public function edit(Perceiver $perceiver)
  {
    //
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Perceiver  $perceiver
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, Perceiver $perceiver)
  {
    //
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Perceiver  $perceiver
    * @return \Illuminate\Http\Response
    */
  public function destroy(Perceiver $perceiver)
  {
    //
  }
}
