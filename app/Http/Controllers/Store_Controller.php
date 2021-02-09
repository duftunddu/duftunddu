<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Store_Controller extends Controller
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
        return view('forms.store_register');
    }

    public function home(){
        // if(!request()->user()->hasRole('store_owner')) {
        //     return redirect('/services_register');
        // }
        
        // $no_of_f = Store::write the rest
        $no_of_f = 5;

        // $store_id = Store::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('store.home',[
            'no_of_f'   =>  $no_of_f,
        ]);
    }
}
