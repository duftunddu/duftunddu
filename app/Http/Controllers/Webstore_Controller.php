<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Webstore_Controller extends Controller
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
        return view('forms.webstore_register');
    }

    public function webstore_client(){
        return view('webstore.client');
    }

    public function webstore_call(){
        // return view('store.profile_entry');
        return redirect('/store_profile');
    }

    public function webstore_client_css(){
        return view('webstore.webstore_client_css');
    }

    public function home(){
        if(!request()->user()->hasRole('webstore_owner')) {
            return redirect('/services_register');
        }
        
        // $no_of_f = Webstore::write the rest
        $no_of_f = 5;

        // $store_id = Webstore::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('webstore.home',[
            'no_of_f'   =>  $no_of_f,
            'api_key'   =>  $api_key,
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


    // To get the domain the call is coming from
    // $_SERVER['HTTP_REFERER']
}