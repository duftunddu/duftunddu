<?php

namespace App\Http\Controllers;

// use App\Research;
use App\Fragrance;
use App\Fragrance_Brand;

use Illuminate\Http\Request;

class Research_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {
        // return view('research.fragrance_review_home',[
        //     // 'store_requests'        => $store_requests,
        //     // 'webstore_requests'     => $webstore_requests,
        // ]);
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

        // return redirect('/home')->with('success', 'Thank you for participating, we will show you again.');
    }


    // public function stores_requests()
    // {
    //     $store_requests = Store::whereNull('request_status')
    //     ->get();
        
    //     $webstore_requests = Webstore::whereNull('request_status')
    //     ->get();
        
    //     // var_dump($ambassadors);
    //     // return;

    //     return view('admin.stores_requests',[
    //         'store_requests'        => $store_requests,
    //         'webstore_requests'     => $webstore_requests,
    //     ]);
    // }
}
