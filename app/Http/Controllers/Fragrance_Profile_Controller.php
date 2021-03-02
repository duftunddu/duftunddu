<?php

namespace App\Http\Controllers;

use App\Season;
use App\Climate;
use App\Skin_Type;
use App\Location;
use App\Profession;
use App\Fragrance_Profile;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $professions    =   Profession::select('name')->get();
        $skin_types     =   Skin_Type::select('name')->get();
        $climates       =   Climate::select('name')->get();
        $seasons        =   Season::select('name')->get();
        
        $currencies     =   Helper::currencies();

        return view('forms.profile_entry',[
            'professions'       =>    $professions,
            'skin_types'        =>    $skin_types,
            'climates'          =>    $climates,
            'seasons'           =>    $seasons,
            'currencies'        =>    $currencies
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
        $this->validate(
            $request, [
            'gender'            =>  ['required', Rule::in(['Male', 'Female','Other'])],
            'dob'               => 'required',
            'profession'        => 'required',
            'skin_type'         => 'required|exists:skin_type,name',
            'sweat'             => 'required',
            'climate'           => 'required|exists:climate,name',
            'season'            => 'required|exists:season,name',
            ],
            
            $messages = [
                'gender.in'             => 'The :attribute is invalid. Please select one from the list.',
                'profession.exists'     => 'The :attribute is invalid. Please select one from the list.',
                'skin_type.exists'      => 'The :attribute is invalid. Please select one from the list.',
                'climate.exists'        => 'The :attribute is invalid. Please select one from the list.',
                'season.exists'         => 'The :attribute is invalid. Please select one from the list.',
            ]);
        
        $valid = false;
        $height_unit = '';
        $validator = Validator::make([], []);
        if( is_null($request->height_cent) && is_null($request->height_feet) && is_null($request->height_inches) ){
            $valid = false;
            $validator->getMessageBag()->add('height_cent',     'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_inches',   'Enter height either in feet & inches or centimeters.');
            $validator->getMessageBag()->add('height_feet',   "");
        }
        else 
        if( !is_null($request->height_cent) ){
            if( (is_null($request->height_feet) && is_null($request->height_inches)) ){
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
            if( (!is_null($request->height_feet) && !is_null($request->height_inches)) ){
                $height_unit = 'feet';
                $valid = true;
            }
            else if( is_null($request->height_feet) ){
                $valid = false;
                $validator->getMessageBag()->add('height_feet', 'Inches are required with Feet.');
            }
            else if( is_null($request->height_inches) ){
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

        $valid = false;
        $weight_unit = '';
        $validator = Validator::make([], []);
        if( is_null($request->kgs) && is_null($request->lbs) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',  'Enter weight either in kgs or pounds.');
            $validator->getMessageBag()->add('lbs',  'Enter weight either in kgs or pounds.');
        }
        else if( (!is_null($request->kgs) && !is_null($request->lbs)) ){
            $valid = false;
            $validator->getMessageBag()->add('kgs',   'Enter weight either in kgs or pounds. Not in both.');
            $validator->getMessageBag()->add('lbs',   'Enter weight either in kgs or pounds. Not in both.');
        }
        else if( is_null($request->kgs) ){
            $valid = true;
            $weight_unit = 'lbs';
        }
        else{
            $valid = true;
            $weight_unit = 'kgs';
        }

        if ( !$valid ) {
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

        $profession_id = Profession::where('name', $request->input('profession'))->pluck('id')->first();
        $skin_type_id  = Skin_type::where('name', $request->input('skin_type'))->pluck('id')->first();
        $climate_id    = Climate::where('name', $request->input('climate'))->pluck('id')->first();
        $season_id     = Season::where('name', $request->input('season'))->pluck('id')->first();

        $location = Helper::current_location();

        DB::transaction(function () use (
            $request, $user_check, $location, $height, $weight,
            $profession_id, $skin_type_id, $climate_id, $season_id) {
            
            $new                    = new Fragrance_Profile();
            $new->users_id          = request()->user()->id;
            
            $new->user_check        = $user_check;
            $new->name              = $request->input('name');
            $new->gender            = $request->input('gender');
            $new->dob               = $request->input('dob');
            $new->profession_id     = $profession_id;
            $new->skin_type_id      = $skin_type_id;
            $new->sweat             = $request->input('sweat');
            $new->height            = $height;
            $new->weight            = $weight;
            $new->location_id       = $location->id;
            $new->climate_id        = $climate_id;
            $new->season_id         = $season_id;
            $new->currency          = $request->input('currency');

            $new->save();
        });
        
        request()->user()->removeRole('new_user');
        request()->user()->assignRole('user');
        
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
