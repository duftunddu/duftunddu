<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;

class Country_Controller extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
//   $countries = country::whereHas('country', function ($query) {
  //    $query->whereId(request()->input('country_id', 0));
  //   })
  //    ->pluck('name', 'id');

//   return response()->json($countries);
  $countries  = country::all();
  $collection = city::all();
  $grouped    = $collection->groupBy('country');

  // $cities = "SELECT * FROM cities WHERE country='$country'";

  // $cities = city::$request->only($keys);
  // $result = mysql_query($query);
  $options = city::all();
  $cities  = $options->find('options');

  return view('forms.brand_entry_try')
   ->with('countries', $countries)
   - with('cities', $cities);

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
  //
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Country  $country
  * @return \Illuminate\Http\Response
  */
 public function show(Country $country)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Country  $country
  * @return \Illuminate\Http\Response
  */
 public function edit(Country $country)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Country  $country
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Country $country)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Country  $country
  * @return \Illuminate\Http\Response
  */
 public function destroy(Country $country)
 {
  //
 }
}
