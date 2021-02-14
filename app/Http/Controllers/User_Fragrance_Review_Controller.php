<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;
use Carbon\Carbon;
use App\Helper\Helper;

use App\User_Fragrance_Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User_Fragrance_Review_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands      = Fragrance_Brand::pluck('name');
        $fragrances  = Fragrance::pluck('name');
      
        return view('research.fragrance_review_entry',[
            'brands'         => $brands,
            'fragrances'     => $fragrances,
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
            'brand'             =>  'required',
            'fragrance'         =>  'required',
            'apply_time'        =>  'required',
            'wear_off_time'     =>  'required',
            'in_out'            =>  'required',
            'spray'             =>  'required',
            'projection'        =>  'required',
            'sillage'           =>  'required',
            'like'              =>  'required',
        ]);
      
        $brand_id = Fragrance_Brand::where('name', $request->input('brand'))
            ->orWhere('normal_name', $request->input('brand'))
            ->pluck('id')
            ->first();

        if($brand_id){
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->where('brand_id', $brand_id)
            ->pluck('id')
            ->first();
        }
        else{        
            $fragrance_id = Fragrance::where('name', $request->input('fragrance'))
            ->orWhere('normal_name', $request->input('fragrance'))
            ->pluck('id')
            ->first();
        }

        $location_id = Helper::current_location()->id;
        $weather_avg = Helper::get_weather_average_data();
        
        // For Debugging:
        // var_dump($weather_avg->snow);return;
        
        $apply_time     = Carbon::parse($request->input('apply_time'));
        $wear_off_time  = Carbon::parse($request->input('wear_off_time'));

        // Longevity
        // TRUE for absolute value
        $longevity = $wear_off_time->diffInMinutes($apply_time, TRUE);

        // Suitability
        // Add Suitability 
        
        // var_dump($suitability);return;

        // Sustainability
        if ($request->input('in_out') == 100) {
            $sustainability = $longevity;
        }
        else{
            $sustainability = $longevity / (100 - $request->input('in_out'));
        }

        // Storing
        DB::transaction(function () use ($request, $location_id, $brand_id, $fragrance_id, 
        $apply_time, $wear_off_time, $longevity, $sustainability, $weather_avg) {

                $new                    = new User_Fragrance_Review();
                $new->users_id          = request()->user()->id;
                $new->location_id       = $location_id;

                if($brand_id){
                    $new->fragrance_brand_id        =   $brand_id;   
                }
                else{
                    $new->fragrance_brand_name      =   $request->input('brand');
                }
                
                if($fragrance_id){
                    $new->fragrance_id              =   $fragrance_id;   
                }
                else{
                    $new->fragrance_name            =   $request->input('fragrance');
                }

                $new->longevity                 =   $longevity;
                // $new->suitability               =   $suitability;
                $new->sustainability            =   $sustainability;
                
                $new->apply_time                =   $apply_time;
                $new->wear_off_time             =   $wear_off_time;
                $new->indoor_time_percentage    =   $request->input('in_out');
                $new->number_of_sprays          =   $request->input('spray');
                $new->projection                =   $request->input('projection');
                $new->sillage                   =   $request->input('sillage');
                $new->like                      =   $request->input('like');

                // If weather is available
                if($weather_avg){
                    $new->temp_avg              =   $weather_avg->temp;
                    $new->hum_avg               =   $weather_avg->hum;
                    $new->dew_point_avg         =   $weather_avg->dew_point;
                    $new->uv_index_avg          =   $weather_avg->uv_index;
                    $new->temp_feels_like_avg   =   $weather_avg->temp_feels_like;
                    $new->atm_pressure_avg      =   $weather_avg->atm_pressure;
                    $new->clouds_avg            =   $weather_avg->clouds;
                    $new->visibility_avg        =   $weather_avg->visibility;
                    $new->wind_speed_avg        =   $weather_avg->wind_speed;
                    $new->rain_avg              =   $weather_avg->rain;
                    $new->snow_avg              =   $weather_avg->snow;
                    $new->weather_main          =   $weather_avg->weather_main;
                    $new->weather_description   =   $weather_avg->weather_desc;
                }

                $new->save();
        });

        return redirect('/home')->with('success', 'Thank you for participating. Remember us the next time you 
        need personalized fragrnance reviews for yourself or to gift someone.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_Fragrance_Review  $user_Fragrance_Review
     * @return \Illuminate\Http\Response
     */
    public function show(User_Fragrance_Review $user_Fragrance_Review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_Fragrance_Review  $user_Fragrance_Review
     * @return \Illuminate\Http\Response
     */
    public function edit(User_Fragrance_Review $user_Fragrance_Review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_Fragrance_Review  $user_Fragrance_Review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_Fragrance_Review $user_Fragrance_Review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_Fragrance_Review  $user_Fragrance_Review
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_Fragrance_Review $user_Fragrance_Review)
    {
        //
    }
}
