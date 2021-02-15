<?php

namespace App\Http\Controllers;

use App\Store;
use App\Store_Stock;
use App\User_Fragrance_Review;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Unavailable_Brands_Fragrances_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        // $all = Store_Stock::whereNull('fragrance_brand_id')->orWhereNull('fragrance_id')->get();
        
        // $brands = Store_Stock::whereNull('fragrance_brand_id')
        // ->get();
        
        // Brands
        $brands = Store_Stock::whereNull('fragrance_brand_id')
        ->get()
        ->pluck('fragrance_brand_name');
        $brands = $brands->merge(Store_Stock::whereNull('fragrance_brand_id')
        ->get()
        ->pluck('fragrance_brand_name'));

        // Fragrances
        $fragrances = Store_Stock::whereNull('fragrance_id')
        ->get()
        ->pluck('fragrance_name');
        $fragrances = $fragrances->merge(Store_Stock::whereNull('fragrance_id')
        ->get()
        ->pluck('fragrance_name'));


        // Get only unique values with in descending order of their appearance.
        $brands = $brands->toArray();
        $fragrances = $fragrances->toArray();

        $brands = array_count_values($brands);
        $fragrances = array_count_values($fragrances);

        arsort($brands);
        arsort($fragrances);

        $brands = array_keys($brands);
        $fragrances = array_keys($fragrances);

        // var_dump($fragrances);return;

        return view('admin.unavailable_brands_fragrances_panel',[
            'brands'        =>  $brands,
            'fragrances'   =>  $fragrances,
        ]);
    }
    

    // public function home(){
    //     if(!request()->user()->hasRole('store_owner')) {
    //         return redirect('/services_register');
    //     }
        
    //     // $no_of_f = Store::write the rest
    //     $no_of_f = 5;

    //     // $store_id = Store::where('users_id',request()->user()->id)->first()->id;
    //     $store_id = 2;

    //     return view('store.home',[
    //         'no_of_f'   =>  $no_of_f,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // $validatedData = $request->validate([ 
        //     'accord_familiy_id' => 'required',
        //     'name'              => 'required|unique:accord',
        // ]);

        // DB::transaction(function () use ($request) {

        //         $new                = new Accord();
        //         $new->name          = $request->input('accord_familiy_id');
        //         $new->name          = $request->input('name');
        //         $new->created_by    = request()->user()->id;
        //         $new->save();
        // });

        // return redirect('/accord_entry')->with('success', 'Accord added successfully.');
    }
}