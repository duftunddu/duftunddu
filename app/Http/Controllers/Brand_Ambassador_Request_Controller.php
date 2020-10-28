<?php

namespace App\Http\Controllers;
use App\Location;
use App\Brand_Tier;
use App\Fragrance_Brand;
use App\Fragrance_Brand_Availability;

use App\Brand_Ambassador_Request;
use App\Brand_Ambassador_Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Brand_Ambassador_Request_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // These checks were made when I was paranoid. Evaluate whether they are necessary.
        if (request()->user()->hasAnyRole('candidate_brand_ambassador', 'new_brand_ambassador')){
            return redirect('application_status');
        }
        elseif(request()->user()->hasRole('brand_ambassador')){            
            return redirect('ambassador_home');
        }

        $brands = Fragrance_Brand::all();
        
        return view('brand_ambassador.register',[
            'brands'        => $brands
        ]);
    }

    public function application_status()
    {
        if(request()->user()->hasRole('brand_ambassador')){
            return redirect('ambassador_home');
        }

        $ambassador = Brand_Ambassador_Request::where('users_id', request()->user()->id)->first();

        return view('brand_ambassador.application_status',[
            'ambassador' => $ambassador
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // 'name'            => 'unique:fragrance_brand',
        'email_work'      => 'unique:brand_ambassador_request|unique:brand_ambassador_profile',
        'linkedin'        => 'required|unique:brand_ambassador_request|unique:brand_ambassador_profile',
        'website'         => 'required',
        ]);

        if(empty($request->input('name')) && empty($request->input('brand_id'))){
            return redirect('brand_ambassador_register');
        }

        if(!empty($request->input('name')) && !empty($request->input('brand_id'))){
            return redirect('brand_ambassador_register');
        }

        DB::transaction(function () use ($request) {
        
            $new                   = new brand_ambassador_request();
            $new->users_id         = request()->user()->id;
            $new->brand_id         = $request->input('brand_id');
            $new->brand_name       = $request->input('name');
            $new->linkedin         = $request->input('linkedin');
            $new->email_work       = $request->input('email_work');
            $new->website          = $request->input('website');
        
            if(empty($request->input('name'))){
            // existing brand
                $new->status           = '2';
            }
            else{
            // new brand
                $new->status           = '0';
            }

            $new->save();
        }); 

        request()->user()->assignRole('candidate_brand_ambassador');

        // Return
        return redirect('application_status')->with('success', 'Your application is submitted. It will be verified shortly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand_Ambassador_Request  $brand_Ambassador_Request
     * @return \Illuminate\Http\Response
     */
    public function show(Brand_Ambassador_Request $brand_Ambassador_Request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand_Ambassador_Request  $brand_Ambassador_Request
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand_Ambassador_Request $brand_Ambassador_Request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand_Ambassador_Request  $brand_Ambassador_Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand_Ambassador_Request $brand_Ambassador_Request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand_Ambassador_Request  $brand_Ambassador_Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand_Ambassador_Request $brand_Ambassador_Request)
    {
        //
    }
}
