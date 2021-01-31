<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Store_Request_Controller extends Controller
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
        return view('store.register');
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
            'name'              => 'required',
            'address'           => 'required',
            // 'latitude'          => 'required',
            // 'longitude'         => 'required',
            'contact_number'    => 'required',
            'social'            => 'nullable',
        ]);

        DB::transaction(function () use ($request) {
        
            $new                    = new store();
            $new->users_id          = request()->user()->id;
            $new->name              = $request->input('name');
            $new->address           = $request->input('address');
            // $new->latitude          = $request->input('latitude');
            // $new->longitude         = $request->input('longitude');
            $new->contact_number    = $request->input('contact_number');
            $new->social            = $request->input('social');
            
            $new->save();
        });

        if(!request()->user()->hasRole('new_store_owner')){
            request()->user()->assignRole('new_store_owner');
        }

        return redirect('/store_application_status')->with('success', 'Your application is submitted. It will be reviewed shortly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store_Request  $store_Request
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        if(!request()->user()->hasRole('new_store_owner')){
            return redirect('store_dashboard');
        }

        $store = Store::firstWhere('users_id', request()->user()->id);
        
        return view('store.application_status',[
            'store' => $store
        ]);
    }
}
