<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ingredient_Controller extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  return view('forms.note_entry');
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
   'name' => 'required',
  ]);

  DB::transaction(function () use ($request) {
   $new       = new ingredient();
   $new->name = $request->input('name');
   $new->save();
  });
  $request->flash();
  return view('forms.note_entry');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Ingredient  $ingredient
  * @return \Illuminate\Http\Response
  */
 public function show(Ingredient $ingredient)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Ingredient  $ingredient
  * @return \Illuminate\Http\Response
  */
 public function edit(Ingredient $ingredient)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Ingredient  $ingredient
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Ingredient $ingredient)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Ingredient  $ingredient
  * @return \Illuminate\Http\Response
  */
 public function destroy(Ingredient $ingredient)
 {
  //
 }
}
