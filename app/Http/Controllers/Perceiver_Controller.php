<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Brand;
use App\Ingredient;
use App\Perceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Perceiver_Controller extends Controller
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
  $fragrances  = fragrance::all();

  return view('forms.genie_input')
   ->with('accords', $accords)
   ->with('ingredients', $ingredients)
   ->with('brands', $brands)
   ->with('fragrances', $fragrances);
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
 public function store(Request $request)
 {
  $this->validate($request, [
   'name'                 => 'required',
   'type'                 => 'required',
   'gender_appropriation' => 'required',
   'cost'                 => 'required',
  ]);

  DB::transaction(function () use ($request) {
   $new             = new perceiver();
   $new->gender     = $request->input('gender');
   $new->profession = $request->input('profession');
   $new->age        = $request->input('age');
   $new->skin_type  = $request->input('skin_type');
   $new->sweat      = $request->input('sweat');
   $new->height     = $request->input('height');
   $new->bodyshape  = $request->input('bodyshape');
   $new->country    = $request->input('country');
   $new->city       = $request->input('city');
   $new->climate    = $request->input('climate');
   $new->season     = $request->input('season');
   $new->fragrance  = $request->input('fragrance');
   $new->like       = $request->input('like');
   $new->comment    = $request->input('comment');
   //  $new-> = $request->input('');
   //  $new-> = $request->input('');
   //  $new-> = $request->input('');
   //  $new-> = $request->input('');

   $new->save();
  });

  return view('forms.genie_input');
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
