<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class Services_Controller extends Controller
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
        return view('forms.services_register');
    }

    public function home(){

        // Change to service_user
        // if(!request()->user()->hasRole('service_user')) {
        // }
        return view('forms.services_home');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->back()->with('error','Please login to proceed.');
        }
        else if(request()->user()->hasRole('new_user')) {
            return redirect()->back()->with('error','Please complete your profile to proceed.');
        }

        if(!$request->brand && !$request->shop && !$request->online_store) {
            // If all empty
            return redirect()->back()->with('error','Please select one to proceed.');
        }
        else if($request->brand && $request->shop || $request->brand && $request->online_store || $request->shop && $request->online_store) {
            // If two full
            return redirect()->back()->with('error','Please select only one to proceed.');
        }
        

        if($request->brand){
            if(request()->user()->hasRole('brand_ambassador')) {
                return redirect()->back()->with('error','You are already a Brand Ambassador. You cannot be ambassador of two brands.');
            }
            return redirect('/brand_ambassador_register');
        }
        else if($request->shop){
            return redirect('/store_proposal');
        }
        else if($request->online_store){
            return redirect('/webstore_proposal');
        }
    }

    // return view('admin.accord_entry',[
    //     'accords' => $accords,
    // ]);


}
