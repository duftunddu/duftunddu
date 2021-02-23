<?php

namespace App\Http\Controllers;

use App\Store;
use Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if(request()->user()->hasRole('new_webstore_owner')){
            return redirect('webstore_application_status')->with('info', 'Your cannot submit another application at the moment. For more info, read the FAQ or mail us at customer-support@duftunddu.com .');
        }
        if(request()->user()->hasRole('new_store_owner')){
            return redirect('store_application_status')->with('info', 'Your cannot submit another application at the moment. For more info, read the FAQ or mail us at customer-support@duftunddu.com .');
        }
        
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

        if(request()->user()->hasAnyRole('new_store_owner', 'new_webstore_owner', 'candidate_brand_ambassador', 'new_brand_ambassador')){
            return redirect('/home');
        }

        $location = Helper::current_location();

        DB::transaction(function () use ($request, $location) {
            $new                    = new store();
            $new->users_id          = request()->user()->id;
            $new->location_id       = $location->id;

            $new->name              = $request->input('name');
            $new->address           = $request->input('address');
            $new->website           = $request->input('website');
            $new->contact_number    = $request->input('contact_number');
            $new->social_link       = $request->input('social');
            
            $new->webstore          = TRUE;
            $new->store             = FALSE;

            $new->save();
        }); 

        request()->user()->assignRole('new_webstore_owner');

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
        // Application Status
        if(!request()->user()->hasRole('new_webstore_owner')){
            return redirect('/webstore_home');
        }

        $store = Webstore::firstWhere('users_id', request()->user()->id);
        
        return view('webstore.application_status',[
            'store' => $store
        ]);
    }
}