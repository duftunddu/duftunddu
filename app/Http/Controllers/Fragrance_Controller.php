<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Type;
use App\Fragrance_Accord;
use App\Fragrance_Brand;
use App\Fragrance_Ingredient;
use App\Ingredient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

class Fragrance_Controller extends Controller
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
 public function index()
 {
    $types       = Fragrance_Type::all();
    $accords     = Accord::all();
    $ingredients = Ingredient::all();
    $brands      = Fragrance_Brand::all();
    
    $currencies  = new ExchangeRate();
    
    return view('forms.fragrance_entry',[
      'types'         => $types,
      'accords'       => $accords,
      'ingredients'   => $ingredients,
      'brands'        => $brands,
      'currencies'    => $currencies->currencies()
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

    DB::transaction(function () use ($request) {

    $new                           = new fragrance();
    $new->brand_id                 = $request->input('brand_id');
    $new->name                     = $request->input('name');
    $new->type_id                  = $request->input('type_id');
    $new->gender     = $request->input('gender');
    $new->cost                     = $request->input('cost');
    $new->currency                 = $request->input('currency');

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
  return redirect('fragrance_entry');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Fragrance  $fragrance
  * @return \Illuminate\Http\Response
  */
 public function show(Fragrance $fragrance)
 {
  //
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
