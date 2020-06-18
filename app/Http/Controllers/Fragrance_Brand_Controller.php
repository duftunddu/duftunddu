<?php

namespace App\Http\Controllers;

use App\Fragrance_Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fragrance_Brand_Controller extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  return view('forms.brand_entry');
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
   'name'   => 'required',
   'tier'   => 'required',
   'origin' => 'required',
  ]);

  DB::transaction(function () use ($request) {
   $new         = new fragrance_brand();
   $new->name   = $request->input('name');
   $new->tier   = $request->input('tier');
   $new->origin = $request->input('origin');
   $new = accord::firstOrNew(
      ['name' => $request->name],
      ['tier' => $request->tier],
      ['origin' => $request->origin],
   );
   
   $new->save();
  });

  $request->session()->reflash();
  
  return view('forms.brand_entry');
 }

 public function index2()
 {
    $fragrance_Brands = Fragrance_Brand::all();
    // return view('forms.brand_output.brand_output')->with('fragrance_Brand',$fragrance_Brands); 
    return view('forms.brand_output',['fragrance_Brand' => $fragrance_Brands]); 
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Fragrance_Brand  $fragrance_Brand
  * @return \Illuminate\Http\Response
  */
 public function show(Fragrance_Brand $fragrance_Brand)
 {
  //   $brand = Fragrance_Brand::find($fragrance_Brand);
  return view('forms.brand_show',['brand'=> $fragrance_Brand]);
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
