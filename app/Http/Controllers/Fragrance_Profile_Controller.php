<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Season;
use App\Climate;
use App\Skin_Type;
use App\Profession;
use App\Fragrance_Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

class Fragrance_Profile_Controller extends Controller
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
        $professions    =   Profession::all();
        $skin_types     =   Skin_Type::all();
        $climates       =   Climate::all();
        $seasons        =   Season::all();

        $countries      =   Country::all();
        $cities         =   City::all();
                
        $currencies     =   new ExchangeRate();

        return view('forms.profile_entry',[
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
            'countries'         =>    $countries,
            'cities'            =>    $cities,
            'currencies'        =>    $currencies->currencies()
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
        $this->validate($request, [
            'gender'            => 'required',
            'dob'               => 'required',
            'profession_id'     => 'required',
            'skin_type_id'      => 'required',
            'sweat'             => 'required',
            'height'            => 'required',
            'weight'            => 'required',
            'country_id'        => 'required',
            'city_id'           => 'required',
            'climate_id'        => 'required',
            'season_id'         => 'required',
        ]);

        $user_check = 0;
        if (request()->user()->hasRole('new_user')){
            $user_check = 1;
        }

        DB::transaction(function () use ($request) {
            
            $new                = new Fragrance_Profile();
            $new->users_id      = request()->user()->id;
            
            $new->user_check        = $user_check;
            $new->gender            = $request->input('gender');
            $new->dob               = $request->input('dob');
            $new->profession_id     = $request->input('profession_id');
            $new->skin_type_id      = $request->input('skin_type_id');
            $new->sweat             = $request->input('sweat');
            $new->height            = $request->input('height');
            $new->weight            = $request->input('weight');
            $new->country_id        = $request->input('country_id');
            $new->city_id           = $request->input('city_id');
            $new->climate_id        = $request->input('climate_id');
            $new->season_id         = $request->input('season_id');
            $new->currency          = $request->input('currency');
            $new->detail            = $request->input('details');

            $new->save();
        });
        
        if (request()->user()->hasRole('new_user')){
            request()->user()->removeRole('new_user');
            request()->user()->assignRole('user');
        }
        
        // Return
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fragrance_Profile  $fragrance_Profile
     * @return \Illuminate\Http\Response
     */
    public function show(Fragrance_Profile $fragrance_Profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fragrance_Profile  $fragrance_Profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Fragrance_Profile $fragrance_Profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fragrance_Profile  $fragrance_Profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fragrance_Profile $fragrance_Profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fragrance_Profile  $fragrance_Profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fragrance_Profile $fragrance_Profile)
    {
        //
    }
}
