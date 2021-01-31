<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Webstore_Request_Controller extends Controller
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
        return view('webstore.register');
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
            'website'           => 'required',
            'contact_number'    => 'required',
            'social'            => 'nullable',
        ]);


        DB::transaction(function () use ($request) {
            $new                    = new webstore_request();
            $new->users_id          = request()->user()->id;
            $new->name              = $request->input('name');
            $new->address           = $request->input('address');
            $new->website           = $request->input('website');
            $new->contact_number    = $request->input('contact_number');
            $new->social            = $request->input('social');
            
            $new->save();
        }); 

        if(!request()->user()->hasRole('new_webstore_owner')){
            request()->user()->assignRole('new_webstore_owner');
        }

        return redirect('/webstore_application_status')->with('success', 'Your application is submitted. It will be reviewed shortly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Webstore_Request  $webstore_Request
     * @return \Illuminate\Http\Response
    */
    public function show(Webstore_Request $webstore_Request)
    {
        if(!request()->user()->hasRole('new_webstore_owner')){
            return redirect('webstore_dashboard');
        }

        $store = Webstore::firstWhere('users_id', request()->user()->id);
        
        return view('webstore.application_status',[
            'store' => $store
        ]);
    }
}
