<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Accord;
use App\Fragrance_Brand;
use App\Fragrance_Ingredient;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fragrance_Controller extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  $accords     = accord::all();
  $ingredients = ingredient::all();
  $brands      = fragrance_brand::all();
  
   return view('forms.fragrance_entry',
   ['accords' => $accords,
   'ingredients' => $ingredients,
   'brands' => $brands]
  );
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
  $this->validate($request, [
   'brand_id'             => 'required',
   'name'                 => 'required',
   'type'                 => 'required',
   'gender'               => 'required',
   'cost'                 => 'required',
  ]);

  DB::transaction(function () use ($request) {
   $new           = new fragrance();
   $new->brand_id = $request->input('brand_id');
   $new->name     = $request->input('name');
   $new->type     = $request->input('type');
   $new->gender_appropriation   = $request->input('gender');
   $new->cost   = $request->input('cost');
   $new->save();

   $fragrance_id = DB::getPdo()->lastInsertId();

  // if ($request->accord_id) {

  //  for ($i = 0; $i < count($request->accord_id); $i++) {
  //   $new               = new fragrance_accord();
  //   $new->fragrance_id = $fragrance_id;
  //   $new->accord_id    = $request->input("id")[$i];
  //   // $new->accord_id    = $request->
  //   $new->save();
  //  }
  // }
  
  $new               = new fragrance_accord();
  $new->fragrance_id = $fragrance_id;
  $new->accord_id    = $request->input("accord_id");
  $new->save();

// });

  // if ($request->ingredient_id) {

  //  for ($j = 0; $j < count($request->ingredient_id); $j++) {
  //   // $result = $this->checkAvailability($request->input('Date_From')[$j], $request->input('Date_Till')[$j], $request->Hotel_Room_ID[$j]);
  //   // if ($result != null) {
  //   //  $id = $request->Hotel_Room_ID[$j];
  //   //  // echo "Room: $id is already booked from $result->Date_From to $result->Date_Till";
  //   //  throw new \Exception("Room: $id is already booked from $result->Date_From to $result->Date_Till");
  //   // }
  //   $new                = new fragrance_ingredient();
  //   $new->fragrance_id  = $fragrance_id;
  //   $new->ingredient_id = $request->input('id')[$j];
  //   $new->note          = $request->input('note')[$j];
  //   $new->strength      = $request->input('strength')[$j];
  //   $new->save();
  //  }
  // }

  $new                = new fragrance_ingredient();
  $new->fragrance_id  = $fragrance_id;
  $new->ingredient_id = $request->input('ingredient_id');
  $new->note          = $request->input('note');
  $new->strength      = $request->input('strength');
  $new->save();
  });

  $request->session()->reflash();

  return $this->index();
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
