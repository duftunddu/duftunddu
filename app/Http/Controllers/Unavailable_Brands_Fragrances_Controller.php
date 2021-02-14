<?php

namespace App\Http\Controllers;

use App\Store;
use App\Store_Stock;

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
        // return view('admin.unavailable_brands_fragrances_panel');

        $all = Store_Stock::whereNull('fragrance_brand_id')->orWhereNull('fragrance_id')->get();

        dd($all);

        return view('admin.unavailable_brands_fragrances_panel',[
            'all'   =>  $all,
        ]);
    }
    

    public function home(){
        if(!request()->user()->hasRole('store_owner')) {
            return redirect('/services_register');
        }
        
        // $no_of_f = Store::write the rest
        $no_of_f = 5;

        // $store_id = Store::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('store.home',[
            'no_of_f'   =>  $no_of_f,
        ]);
    }

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