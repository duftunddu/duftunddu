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
        // $brands      = Fragrance_Brand::all();
        $brands      = Fragrance_Brand::pluck('name');
        $fragrances  = Fragrance::all();
      
        return view('research.fragrance_review_entry',[
            'brands'         => $brands,
            'fragrances'     => $fragrances,
        ]);
    }

    public function home()
    {
        return view('research.fragrance_review_home',[
            // 'store_requests'        => $store_requests,
            // 'webstore_requests'     => $webstore_requests,
        ]);
    }

    public function stores_requests()
    {
        $store_requests = Store::whereNull('request_status')
        ->get();
        
        $webstore_requests = Webstore::whereNull('request_status')
        ->get();
        
        // var_dump($ambassadors);
        // return;

        return view('admin.stores_requests',[
            'store_requests'        => $store_requests,
            'webstore_requests'     => $webstore_requests,
        ]);
    }

    //
}
