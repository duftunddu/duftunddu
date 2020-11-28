<?php

namespace App\Http\Controllers;

use App\Season;
use App\Climate;
use App\Skin_Type;
use App\Location;
use App\Profession;
use App\Fragrance_Profile;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;

use App\Helper\Helper;

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
        
        $currencies     =   new ExchangeRate();

        return view('forms.profile_entry',[
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
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
            // 'height_feet'       => 'nullable|required_if:height_cent,null|required_with:height_inches',
            // 'height_feet'       => ['nullable|required_if:height_cent,null|required_with:height_inches'],
            // 'height_inches'     => 'nullable|required_if:height_cent,null|required_with:height_feet',
            // 'height_cent'       => 'nullable|required_if:height_feet,null|required_if:height_inches,null',
            // 'weight'            => 'required',
            'climate_id'        => 'required',
            'season_id'         => 'required',
        ]);
        
        $valid = false;
        $height_unit = '';
        $validator = Validator::make([], []);
        if( empty($request->height_cent) && empty($request->height_feet) && empty($request->height_inches) ){
            $valid = false;
            $validator->getMessageBag()->add('height_cent',     'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_inches',   'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_feet',   "");
        }
        else 
        if( !empty($request->height_cent) ){
            if( (empty($request->height_feet) && empty($request->height_inches)) ){
                $height_unit = 'cent';
                $valid = true;
            }
            else{
                $valid = false;
                $validator->getMessageBag()->add('height_cent',     'Enter height either in feet & inches or centimeters. Not in both.');
                $validator->getMessageBag()->add('height_inches',   'Enter height either in feet & inches or centimeters. Not in both.');
                $validator->getMessageBag()->add('height_feet',   "");
            }
        }
        else{
            if( (!empty($request->height_feet) && !empty($request->height_inches)) ){
                $height_unit = 'feet';
                $valid = true;
            }
            else if( empty($request->height_feet) ){
                $valid = false;
                $validator->getMessageBag()->add('height_feet', 'Inches are required with Feet.');
            }
            else if( empty($request->height_inches) ){
                $valid = false;
                $validator->getMessageBag()->add('height_inches', 'Feet is required with inches. Put zero if zero inches.');
            }
        }
        
        if (!$valid ) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $weight_unit = '';
        $valid = false;
        $validator = Validator::make([], []);
        if( empty($request->kgs) && empty($request->lbs) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',  'Enter weight either in kgs or pounds.');
            $validator->getMessageBag()->add('lbs',  'Enter weight either in kgs or pounds.');
        }
        else if( (!empty($request->kgs) && !empty($request->lbs)) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',   'Enter weight either in kgs or pounds. Not in both.');
            $validator->getMessageBag()->add('lbs',   'Enter weight either in kgs or pounds. Not in both.');
        }
        else if( empty($request->kgs) ){
            $valid = true;
            $weight_unit = 'lbs';
        }
        else{
            $valid = true;
            $weight_unit = 'kgs';
        }

        if (!$valid ) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_check = 0;
        if (request()->user()->hasRole('new_user')){
            $user_check = 1;
        }
        
        $height = 0;
        if($height_unit == 'cent'){
            $height = $request->input('height_cent');
        }
        else{
            $height = $request->input('height_feet') * 12 + $request->input('height_inches');
        }

        $weight = 0;
        if($weight_unit == 'kgs'){
            $weight = $request->input('kgs');
        }
        else{
            $weight = $request->input('lbs') * 2.205;
        }

        $location = Helper::current_location();

        DB::transaction(function () use ($request, $user_check, $location) {
            
            $new                    = new Fragrance_Profile();
            $new->users_id          = request()->user()->id;
            
            $new->user_check        = $user_check;
            $new->name              = $request->input('name');
            $new->gender            = $request->input('gender');
            $new->dob               = $request->input('dob');
            $new->profession_id     = $request->input('profession_id');
            $new->skin_type_id      = $request->input('skin_type_id');
            $new->sweat             = $request->input('sweat');
            $new->height            = $height;
            $new->weight            = $weight;
            $new->location_id       = $location->id;
            $new->climate_id        = $request->input('climate_id');
            $new->season_id         = $request->input('season_id');
            $new->currency          = $request->input('currency');

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
