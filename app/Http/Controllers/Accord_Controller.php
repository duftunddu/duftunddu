<?php

namespace App\Http\Controllers;

use App\Accord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Finder\Finder;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Accord_Controller extends Controller
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
  
// finder
// $finder = new Finder();
// // find all files in the current directory
// $finder->files()->in('C:\Users\Abdul Samad\tryproject\python_scripts')->name('*.py');
// // $finder->files()->in(__DIR__);

// // check if there are any search results
// if ($finder->hasResults()) {
//     var_dump($finder);
// }
// return;

// process
  //   $text = $request->input('name');
  //   $process = new Process(["python3 C:\Users\Abdul Samad\tryproject\python_scripts/unidecode_string.py \"{$text}\""]);
  //   // $process = new Process(['unidecode_string.py']);

  // // $process = new Process(['C:\Users\Abdul Samad\tryproject\python_scripts', 'unidecode_string.py']);
  // $process = new Process(['unidecode_string.py', $request->input('name')]);
  // // $process->setInput($request->input('name'));
  // $process->run();

  // // executes after the command finishes
  // if (!$process->isSuccessful()) {
  //     throw new ProcessFailedException($process);
  // }
  
  // var_dump($process->getOutput());
  // return;
  
  $validatedData = $request->validate([
    'name' => 'required|unique:accord',
  ]);
  
  DB::transaction(function () use ($request) {
    
    $new          = new Accord();
    $new->name    = $request->input('name');
    $new->save();

  });

  return redirect('accord_entry');
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


  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes()
  {
      return [
          'name' => 'accord',
      ];
  }
}