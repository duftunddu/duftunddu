<?php

namespace App\Http\Controllers;

use App\Accord;
use App\Fragrance;
use App\Fragrance_Type;
use App\Fragrance_Accord;
use App\Fragrance_Brand;
use App\Fragrance_Ingredient;
use App\Ingredient;
use App\Brand_Ambassador_Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

use App\Helper\Helper;

class Fragrance_Controller extends Controller
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
      $types       = Fragrance_Type::all();
      $accords     = Accord::all();
      $ingredients = Ingredient::all();
      $brands      = Fragrance_Brand::all();
      
      $currencies  = new ExchangeRate();
      
      return view('admin.fragrance_entry',[
        'types'         => $types,
        'accords'       => $accords,
        'ingredients'   => $ingredients,
        'brands'        => $brands,
        'currencies'    => $currencies->currencies()
        ]);
  }

  public function index_ba()
  {
    $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();

    $brand = Fragrance_Brand::find($ambassador->brand_id);
    
    $types       = Fragrance_Type::all();
    $accords     = Accord::all();
    $ingredients = Ingredient::all();
    $currencies  = new ExchangeRate();
    
    return view('brand_ambassador.fragrance_entry',[
      'brand'         => $brand,
      'types'         => $types,
      'accords'       => $accords,
      'ingredients'   => $ingredients,
      
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

      $normal_name = Helper::normalize_name($request->input('name'));

      DB::transaction(function () use ($request, $normal_name) {

      $new                            = new fragrance();
      $new->brand_id                  = $request->input('brand_id');
      $new->name                      = $request->input('name');
      $new->normal_name               = $normal_name;
      $new->type_id                   = $request->input('type_id');
      $new->gender                    = $request->input('gender');
      $new->cost                      = $request->input('cost');
      $new->currency                  = $request->input('currency');
      $new->created_by                = request()->user()->id;

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
    return redirect()->back()->with('success','Fragrance added successfully.');
  }

  public function store_ba(Request $request)
  {
      $validatedData = $request->validate([
        'name'                 => 'required|unique:fragrance',
        'type_id'              => 'required',
        'gender'               => 'required',
        'cost'                 => 'required',
        'currency'             => 'required',
        
        'accord_id'            => 'required',
        'ingredient_id'        => 'required',
      ]);

      $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();

      $normal_name = Helper::normalize_name($request->input('name'));

      DB::transaction(function () use ($request, $ambassador, $normal_name) {

      $new                            = new fragrance();
      $new->brand_id                  = $ambassador->brand_id;
      $new->name                      = $request->input('name');
      $new->normal_name               = $normal_name;
      $new->type_id                   = $request->input('type_id');
      $new->gender                    = $request->input('gender');
      $new->cost                      = $request->input('cost');
      $new->currency                  = $request->input('currency');
      $new->created_by                = request()->user()->id;

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
    return redirect('ambassador_home')->with('success','Fragrance added successfully.');
  }

  public function all_fragrances($id)
  {
    $brand = Fragrance_Brand::find($id);
    
    if(empty($brand)){
      return redirect()->route('search');
    }
    // }

    $fragrances = Fragrance::where('brand_id', $brand->id)->get();

    return view('forms.fragrances',[
        'brand'        => $brand,
        'fragrances'   => $fragrances
    ]);
  }

  /**
    * Display the specified resource.
    *
    * @param  \App\Fragrance  $fragrance
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
    $fragrance = Fragrance::find($id);

    if(empty($fragrance)){
      return redirect()->route('search');
    }

    $type = Fragrance_Type::find($fragrance->type_id)->first();

    $accords = DB::table('fragrance_accord')
        ->join('accord', 'accord.id', '=', 'fragrance_accord.accord_id')
        ->where('fragrance_accord.id',$id)
        ->select('accord.name')
        ->get();

    $notes = DB::table('fragrance_ingredient')
        ->join('ingredient', 'ingredient.id', '=', 'fragrance_ingredient.ingredient_id')
        ->where('fragrance_ingredient.id',$id)
        ->select('ingredient.name')
        ->get();


    $allow_edit = FALSE;
    if (Auth::check()) {
        if(request()->user()->hasRole(['brand_ambassador', 'premium_brand_ambassador'])){
          $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();
          if($ambassador->brand_id == $fragrance->brand_id){
            $allow_edit = TRUE;
          }
        }
    }

    return view('forms.fragrance',[
        'fragrance'     => $fragrance,
        'type'      => $type,
        'accords'      => $accords,
        'notes'    => $notes,
        'allow_edit'    => $allow_edit,
    ]);
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
