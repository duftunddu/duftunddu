<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function home(){
        // if(!request()->user()->hasRole('store_owner')) {
        //     return redirect('/services_register');
        // }
        
        // $no_of_f = Webstore::write the rest
        $no_of_f = 5;

        // $store_id = Webstore::where('users_id',request()->user()->id)->first()->id;
        $store_id = 2;

        return view('webstore.home',[
            'no_of_f'   =>  $no_of_f,
            'api_key'   =>  $api_key,
        ]);
    }

    // To get the domain the call is coming from
    // $_SERVER['HTTP_REFERER']
}