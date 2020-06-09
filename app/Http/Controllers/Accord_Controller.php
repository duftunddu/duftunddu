<?php

namespace App\Http\Controllers;

use App\Accord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Accord_Controller extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  return view('forms.accord_entry');
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

  //   $accords = accord::all();
  //   foreach ($accords as $accord) {
  //    accord::firstOrCreate(['name' => $accord->name]);
  //   }

  DB::transaction(function () use ($request) {
   $new       = new accord();
   $new->name = $request->input('name');
   $new->save();
  });

  return view('forms.accord_entry');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Accord  $accord
  * @return \Illuminate\Http\Response
  */
 public function show(Accord $accord)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Accord  $accord
  * @return \Illuminate\Http\Response
  */
 public function edit(Accord $accord)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Accord  $accord
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Accord $accord)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Accord  $accord
  * @return \Illuminate\Http\Response
  */
 public function destroy(Accord $accord)
 {
  //
 }
}
