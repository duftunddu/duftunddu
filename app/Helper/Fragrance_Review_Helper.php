<?php namespace App\Helper;

// For Review
use App;

use App\Fragrance;
use App\Fragrance_Accord;
use App\Fragrance_Profile;
use App\User_Fragrance_Review;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Fragrance_Review_Helper {

    public function __construct() {
        // 
    }
    


    // Review Calculators

    // Get Suitability of a Fragrance
    // public function get_suitability_from_fragrance ($fragrance_id)
    // {
    //     return Fragrance::find($fragrance_id)->first()->suitability;
    // }

    // Get Review
    public function get_longevity($fragrance_id)
    {   
        // Fetching Data
        $fragrance_review_helper    =   new Fragrance_Review_Helper();
        $fragrance_data             =   json_encode($fragrance_review_helper->get_longevity_fragrance_data($fragrance_id));
        $profile_data               =   json_encode($fragrance_review_helper->get_longevity_profile_data());
        
        $helper                     =   new Helper();
        $weather_data               =   json_encode($helper->get_weather_average_data());
        // $weather_data               =   $helper->get_weather_average_data();

        // dd($weather_data);

        // For debugging
        // $fragrance_review_helper->save_longevity_template($fragrance_data, $profile_data, $weather_data);

        // Calculating
        if (App::environment('local')) {
            // The environment is local

            $process = new Process([ 'C:\Anaconda3\Scripts\activate_duft_und_du.bat', 'longevity_prediction_random_forest.py',
                $fragrance_data, $profile_data, $weather_data], null, [ 'PYTHONHASHSEED' => "1", 'SystemRoot' => "C:\\WINDOWS", 'Home' => 'C:\\Anaconda3\\envs\\duft_und_du']);
        }
        else {
            // if (App::environment('production')) {
            // The environment is not local ...

            $process = new Process([ 'python3.8', 'longevity_prediction.py',
                $fragrance_data, $profile_data, $weather_data], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }

        $process->run();

        // dd($process->getOutput());
        var_dump($process->getErrorOutput()); return;

        // executes after the command finishes
        if ( !$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Change sufficient values to 5
        $arr = (object) [
            'value'         => (float) $process->getOutput(),
            'sufficient'    => User_Fragrance_Review::where('fragrance_id', $fragrance_id)->count() > 2 ? true : false,
        ];

        return $arr;
    }

    public function get_suitability($fragrance_id)
    {

        // $fragrance = Fragrance::find($fragrance_id)
        // ->join(); 
        // return $fragrance;

        // Use the model here

        // Weather Data
        // Weather: Cold weather/region holds stronger, lusher floral notes in check, which is why your tropical perfumes will smell all wrong during winter or autumn. Conversely, lighter scents work better in summer and spring.
        $weather_data = new Helper();
        $weather_data = $weather_data->get_weather_average_data();
        
        // Fragrance Data
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $accords = $fragrance_review_helper->get_accords_of_fragrance_array($fragrance_id);


        // Function
        $suitability = 100;
        if($weather_data->temp > 65){
            if( in_array("Floral", $accords) ){
                $suitability *= 1.1;
            }
        }
        else{
            if( in_array("Tropical", $accords) ){
                $suitability *= 1.1;
            }
        }

        $arr = (object) [
            'value'         => (int) $suitability,
            'sufficient'    => false,
        ];

        // Return
        return $arr;
    }


    public function get_sustainability($fragrance_id)
    {
        // Fetching Data
        $fragrance_review_helper = new Fragrance_Review_Helper(); 
        $data = $fragrance_review_helper->get_sustainability_data($fragrance_id);

        if($data->isEmpty()){
            return -1;
        }

        // For debugging
        // $fragrance_review_helper->save_sustainability_template($data);

        // Calculating
        if (App::environment('local')) {
            // The environment is local

            $process = new Process([ 'C:\Anaconda3\Scripts\activate_duft_und_du.bat', 'sustainability.py',
                $data], null, [ 'PYTHONHASHSEED' => "1", 'SystemRoot' => "C:\\WINDOWS"]);
        }
        else {
            // if (App::environment('production')) {
            // The environment is not local ...

            $process = new Process([ 'python3.8', 'sustainability.py',
                $data], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }

        $process->run();

        // var_dump($process->getErrorOutput()); return;

        // executes after the command finishes
        if ( !$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return (int) $process->getOutput();
    }


    public function get_indoor_outdoor()
    {
        // 
    }
    

    

    // Review Calculation Helpers

    // Suitability
    public function get_suitability_array ($store_id){
        
        // Weather: Cold weather/region holds stronger, lusher floral notes in check, which is why your tropical perfumes will smell all wrong during winter or autumn. Conversely, lighter scents work better in summer and spring.
        
        $weather_data = new Helper();
        $weather_data = $weather_data->get_weather_average_data();
        
        $store = new Store_Helper();
        $fragrances = $store->get_store_stock_with_accords();

        return $fragrances;

        $suitability = 100;
        if($weather_data->avg_temp > 65){
          if( in_array("Floral", $accords) ){              
            $suitability *= 1.1;
          }
        }
        else{
          if( in_array("Tropical", $accords) ){
            $suitability *= 1.1;
          }
        }

        return $suitability;
    }


    // Get Accords of Fragrance
    public function get_accords_of_fragrance_array ($fragrance_id)
    {
        $accords = Fragrance_Accord::where('fragrance_id', $fragrance_id)
        ->join('accord', 'accord.id', 'accord_id')
        ->pluck('accord.name')
        ->toArray();

        return $accords;
    }

    
    // Longevity
    public function get_longevity_data_fields ()
    {
        $arr = [
        //     // Table: User Fragrance Review
        'user_fragrance_review.id as ufr_id',
        'user_fragrance_review.longevity as longevity',
        'user_fragrance_review.apply_time as apply_time',
        'user_fragrance_review.wear_off_time as wear_off_time',
        // 'user_fragrance_review.indoor_time_percentage as indoor_time_percentage',
        'user_fragrance_review.number_of_sprays as number_of_sprays',
        // 'user_fragrance_review.projection as projection',
        // 'user_fragrance_review.sillage as sillage',
        // 'user_fragrance_review.like as like',
        'user_fragrance_review.temp_avg as temp_avg',
        'user_fragrance_review.hum_avg as hum_avg',
        'user_fragrance_review.dew_point_avg as dew_point_avg',
        'user_fragrance_review.uv_index_avg as uv_index_avg',
        'user_fragrance_review.temp_feels_like_avg as temp_feels_like_avg',
        'user_fragrance_review.atm_pressure_avg as atm_pressure_avg',
        'user_fragrance_review.clouds_avg as clouds_avg',
        'user_fragrance_review.visibility_avg as visibility_avg',
        'user_fragrance_review.wind_speed_avg as wind_speed_avg',
        'user_fragrance_review.rain_avg as rain_avg',
        'user_fragrance_review.snow_avg as snow_avg',
        'user_fragrance_review.weather_main as weather_main',
        // 'user_fragrance_review.weather_description as weather_description',


        // Table: Users
        // 'users.id as users_id',


        // Table: Fragrance Profile
        'fragrance_profile.id as fp_id',
        // 'fragrance_profile.user_check as user_check',
        'fragrance_profile.gender as gender',
        'fragrance_profile.dob as dob',
        'fragrance_profile.sweat as sweat',
        'fragrance_profile.height as height',
        'fragrance_profile.weight as weight',


        // Fragrance Profile Dependencies
        'profession.name as profession',
        'skin_type.name as skin_type',
        // 'climate.name as climate',
        'season.name as season',

        'fp_location.country_name as fp_country',
        // 'fp_location.time_zone as fp_time_zone',


        // Table: Fragrance
        // 'fragrance.id as fragrance_id',
        'fragrance.name as fragrance',
        'fragrance.gender as fragrance_gender',
        // 'fragrance.discontinued as fragrance_discontinued',
        
        // Fragrance Types
        'fragrance_type.name as fragrance_type',

        // Table: Accords & Ingredients
        // 'accord.name as accord',
        // 'ingredient.name as ingredient',

        
        // Table: Brand
        // 'fragrance_brand.id as brand_id',
        'fragrance_brand.name as brand',
        // 'fragrance_brand.discontinued as brand_discontinued',

        // Brand Tier
        'brand_tier.name as brand_tier',
        
        // Bran Origin
        // 'bo_location.country_name as bo_location_country',
        // 'bo_location.time_zone as bo_location_zone',

        // Brand Outlets
        // 'fba_location.country_name as fba_location_country',
        // 'fba_location.time_zone as fba_location_zone',
        ];

        return $arr;
    }

    public function get_longevity_data ($fragrance_id)
    {
        // Field names
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_longevity_data_fields();

        // Calling data
        $all = User_Fragrance_Review::join('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        ->join('users', 'users.id', 'user_fragrance_review.users_id')
        ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        
        ->join('profession', 'profession.id', 'fragrance_profile.profession_id')
        ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        ->join('season', 'season.id', 'fragrance_profile.season_id')
        
        ->join('fragrance', 'fragrance.id', 'user_fragrance_review.fragrance_id')
        ->join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        
        // ->join('fragrance_ingredient', 'fragrance_ingredient.fragrance_id', 'fragrance.id')
        // ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        // ->join('ingredient', 'ingredient.id', 'fragrance_ingredient.id')
        // ->join('accord', 'accord.id', 'fragrance_accord.id')

        ->join('fragrance_brand', 'fragrance_brand.id', 'fragrance.brand_id')
        ->join('brand_tier', 'brand_tier.id', 'fragrance_brand.tier_id')
        ->join('location as bo_location', 'bo_location.id', 'fragrance_brand.origin_id')
        
        // ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', 'fragrance_brand.id')
        // ->join('location as fba_location', 'fba_location.id', 'fragrance_brand_availability.location_id')
        ->where('fragrance.id', $fragrance_id)
        ->select($fields)
        ->get();

        // $all = User_Fragrance_Review::join('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        // ->join('users', 'users.id', 'user_fragrance_review.users_id')
        // ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        
        // ->join('profession', 'profession.id', 'fragrance_profile.profession_id')
        // ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        // ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        // ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        // ->join('season', 'season.id', 'fragrance_profile.season_id')
        
        // ->join('fragrance', 'fragrance.id', 'user_fragrance_review.fragrance_id')
        // ->join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        
        // // ->join('fragrance_ingredient', 'fragrance_ingredient.fragrance_id', 'fragrance.id')
        // // ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        // // ->join('ingredient', 'ingredient.id', 'fragrance_ingredient.id')
        // // ->join('accord', 'accord.id', 'fragrance_accord.id')

        // ->join('fragrance_brand', 'fragrance_brand.id', 'fragrance.brand_id')
        // ->join('brand_tier', 'brand_tier.id', 'fragrance_brand.tier_id')
        // ->join('location as bo_location', 'bo_location.id', 'fragrance_brand.origin_id')
        
        // // ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', 'fragrance_brand.id')
        // // ->join('location as fba_location', 'fba_location.id', 'fragrance_brand_availability.location_id')
        // ->where('fragrance.id', $fragrance_id)
        // ->select($fields)
        // ->get();

        // $all = DB::table('user_fragrance_review')
        // ->where('fragrance.id', $fragrance_id)
        // ->join('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        // ->join('users', 'users.id', 'user_fragrance_review.users_id')
        // ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        
        // ->join('profession', 'profession.id', 'fragrance_profile.profession_id')
        // ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        // ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        // ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        // ->join('season', 'season.id', 'fragrance_profile.season_id')
        
        // ->join('fragrance', 'fragrance.id', 'user_fragrance_review.fragrance_id')
        // ->join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        
        // // ->join('fragrance_ingredient', 'fragrance_ingredient.fragrance_id', 'fragrance.id')
        // // ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        // // ->join('ingredient', 'ingredient.id', 'fragrance_ingredient.id')
        // // ->join('accord', 'accord.id', 'fragrance_accord.id')

        // ->join('fragrance_brand', 'fragrance_brand.id', 'fragrance.brand_id')
        // ->join('brand_tier', 'brand_tier.id', 'fragrance_brand.tier_id')
        // ->join('location as bo_location', 'bo_location.id', 'fragrance_brand.origin_id')
        
        // // ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', 'fragrance_brand.id')
        // // ->join('location as fba_location', 'fba_location.id', 'fragrance_brand_availability.location_id')
        
        // ->select($fields)
        // ->get();

        // Return
        return $all;
    }

    public function get_longevity_fragrance_data_fields ()
    {
        $arr = [
            // Fragrance
            'fragrance.name as fragrance',
            'fragrance.gender as fragrance_gender',
            
            // Fragrance Types
            'fragrance_type.name as fragrance_type',
            
            // Table: Brand
            'fragrance_brand.name as brand',
    
            // Brand Tier
            'brand_tier.name as brand_tier',
        ];

        return $arr;
    }

    public function get_longevity_fragrance_data ($fragrance_id)
    {
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_longevity_fragrance_data_fields();

        $all = Fragrance::
        join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        
        // ->join('fragrance_ingredient', 'fragrance_ingredient.fragrance_id', 'fragrance.id')
        // ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        // ->join('ingredient', 'ingredient.id', 'fragrance_ingredient.id')
        // ->join('accord', 'accord.id', 'fragrance_accord.id')

        ->join('fragrance_brand', 'fragrance_brand.id', 'fragrance.brand_id')
        ->join('brand_tier', 'brand_tier.id', 'fragrance_brand.tier_id')
        // ->join('location as bo_location', 'bo_location.id', 'fragrance_brand.origin_id')
        
        // ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', 'fragrance_brand.id')
        // ->join('location as fba_location', 'fba_location.id', 'fragrance_brand_availability.location_id')
        ->where('fragrance.id', $fragrance_id)
        ->select($fields)
        ->first();

        return $all;
    }

    public function get_longevity_profile_data_fields ()
    {
        $arr = [
            // Fragrance Profile
            'fragrance_profile.id as fp_id',
            // 'fragrance_profile.user_check as user_check',
            'fragrance_profile.gender as gender',
            'fragrance_profile.dob as dob',
            'fragrance_profile.sweat as sweat',
            'fragrance_profile.height as height',
            'fragrance_profile.weight as weight',

            // Fragrance Profile Dependencies
            'profession.name as profession',
            'skin_type.name as skin_type',
            // 'climate.name as climate',
            'season.name as season',
    
            'fp_location.country_name as fp_country',
        ];

        return $arr;
    }

    public function get_longevity_profile_data ()
    {
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_longevity_profile_data_fields();

        $all = Fragrance_Profile::
        // ->join('users', 'users.id', 'user_fragrance_review.users_id')
        // ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        join('profession', 'profession.id', 'fragrance_profile.profession_id')
        ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        ->join('season', 'season.id', 'fragrance_profile.season_id')
        ->where('fragrance_profile.users_id', request()->user()->id)
        ->select($fields)
        ->first();

        return $all;
    }

    public function save_longevity_template ($fragrance_data, $profile_data, $weather_data)
    {
        if (App::environment('local')) {
            // The environment is local

            $process = new Process([ 'C:\Anaconda3\Scripts\activate_duft_und_du.bat', 'longevity_template_save.py',
                $fragrance_data, $profile_data, $weather_data], null, [ 'PYTHONHASHSEED' => "1", 'SystemRoot' => "C:\\WINDOWS"]);
        }
        else {
            // if (App::environment('production')) {
            // The environment is not local ...

            $process = new Process([ 'python3', 'longevity_template_save.py',
                $fragrance_data, $profile_data, $weather_data], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }

        $process->run();

        // var_dump($process->getErrorOutput()); return;

        // executes after the command finishes
        if ( !$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // return $process->getOutput();
    }


    // Sustainability
    public function get_sustainability_data_fields ()
    {
        $arr = [
            // Table: User Fragrance Review
            // 'user_fragrance_review.id as ufr_id',
            // 'fba_location.country_name as fba_country_name',
            // 'fba_location.time_zone as fba_time_zone',
            'user_fragrance_review.longevity as longevity',
            // 'user_fragrance_review.suitability as suitability',
            // 'user_fragrance_review.sustainability as sustainability',
            // 'user_fragrance_review.apply_time as apply_time',
            // 'user_fragrance_review.wear_off_time as wear_off_time',
            'user_fragrance_review.indoor_time_percentage as indoor_time_percentage',
            'user_fragrance_review.number_of_sprays as number_of_sprays',
            // 'user_fragrance_review.projection as projection',
            // 'user_fragrance_review.sillage as sillage',
            // 'user_fragrance_review.like as like',
            'user_fragrance_review.temp_avg as temp_avg',
            'user_fragrance_review.hum_avg as hum_avg',
            'user_fragrance_review.dew_point_avg as dew_point_avg',
            // 'user_fragrance_review.uv_index_avg as uv_index_avg',
            'user_fragrance_review.temp_feels_like_avg as temp_feels_like_avg',
            'user_fragrance_review.atm_pressure_avg as atm_pressure_avg',
         


            // Table: Users
            'users.id as users_id',


            // Table: Fragrance Profile
            // 'fragrance_profile.id as fp_id',
        ];

        return $arr;
    }

    public function get_sustainability_data ($fragrance_id)
    {
        // Field names
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_sustainability_data_fields();

        // Calling data
        $all = User_Fragrance_Review::join('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        // $all = db('user_fragrance_review')::join('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        ->join('users', 'users.id', 'user_fragrance_review.users_id')
        // ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        
        // ->join('profession', 'profession.id', 'fragrance_profile.profession_id')
        // ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        // ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        // ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        // ->join('season', 'season.id', 'fragrance_profile.season_id')
        
        ->join('fragrance', 'fragrance.id', 'user_fragrance_review.fragrance_id')
        // ->join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        ->where('fragrance.id', $fragrance_id)
        ->select($fields)
        ->get();

        // Return
        return $all;
    }

    public function save_sustainability_template ($data)
    {
        if (App::environment('local')) {
            // The environment is local

            $process = new Process([ 'C:\Anaconda3\envs\duft_und_du\python.exe', 'sustainability_template_save.py', 
                $data], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }
        else {
            // if (App::environment('production')) {
            // The environment is not local ...

            $process = new Process([ 'python3', 'sustainability_template_save.py',
                $data], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }

        $process->run();

        // executes after the command finishes
        if ( !$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }




    // For Review Download
    public function get_fragrance_review_data_fields()
    {
        $arr = [
            // Table: User Fragrance Review
            'user_fragrance_review.id as ufr_id',
            'fba_location.country_name as fba_country_name',
            'fba_location.time_zone as fba_time_zone',
            'user_fragrance_review.longevity as longevity',
            'user_fragrance_review.suitability as suitability',
            'user_fragrance_review.sustainability as sustainability',
            'user_fragrance_review.apply_time as apply_time',
            'user_fragrance_review.wear_off_time as wear_off_time',
            'user_fragrance_review.indoor_time_percentage as indoor_time_percentage',
            'user_fragrance_review.number_of_sprays as number_of_sprays',
            'user_fragrance_review.projection as projection',
            'user_fragrance_review.sillage as sillage',
            'user_fragrance_review.like as like',
            'user_fragrance_review.temp_avg as temp_avg',
            'user_fragrance_review.hum_avg as hum_avg',
            'user_fragrance_review.dew_point_avg as dew_point_avg',
            'user_fragrance_review.uv_index_avg as uv_index_avg',
            'user_fragrance_review.temp_feels_like_avg as temp_feels_like_avg',
            'user_fragrance_review.atm_pressure_avg as atm_pressure_avg',
            'user_fragrance_review.clouds_avg as clouds_avg',
            'user_fragrance_review.visibility_avg as visibility_avg',
            'user_fragrance_review.wind_speed_avg as wind_speed_avg',
            'user_fragrance_review.rain_avg as rain_avg',
            'user_fragrance_review.snow_avg as snow_avg',
            'user_fragrance_review.weather_main as weather_main',
            'user_fragrance_review.weather_description as weather_description',


            // Table: Users
            'users.id as users_id',


            // Table: Fragrance Profile
            'fragrance_profile.id as fp_id',
            'fragrance_profile.user_check as user_check',
            'fragrance_profile.gender as gender',
            'fragrance_profile.dob as dob',
            'fragrance_profile.sweat as sweat',
            'fragrance_profile.height as height',
            'fragrance_profile.weight as weight',


            // Fragrance Profile Dependencies
            'profession.name as profession',
            'skin_type.name as skin_type',
            'climate.name as climate',
            'season.name as season',

            'fp_location.country_name as fp_country',
            'fp_location.time_zone as fp_time_zone',


            // Table: Fragrance
            'fragrance.id as fragrance_id',
            'fragrance.name as fragrance',
            'fragrance.gender as fragrance_gender',
            'fragrance.discontinued as fragrance_discontinued',
            // 'fragrance.sillage as sillage',
            // 'fragrance.avg_hum as avg_hum',
            
            // Fragrance Types
            'fragrance_type.name as fragrance_type',

            // Table: Accords & Ingredients
            // 'accord.name as accord',
            // 'ingredient.name as ingredient',

            
            // Table: Brand
            'fragrance_brand.id as brand_id',
            'fragrance_brand.name as brand',
            'fragrance_brand.discontinued as brand_discontinued',

            // Brand Tier
            'brand_tier.name as brand_tier',
            
            // Bran Origin
            'bo_location.country_name as bo_location_country',
            'bo_location.time_zone as bo_location_zone',

            // Brand Outlets
            'fba_location.country_name as fba_location_country',
            'fba_location.time_zone as fba_location_zone',
        ];

        return $arr;
    }

    public function get_fragrance_review_data_fields_export()
    {
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_fragrance_review_data_fields();

        for($i = 0; $i < count($fields); $i++){
            if(str_contains($fields[$i], ' ')) {
                $fields[$i] = strrchr($fields[$i], ' ');
                $fields[$i] = trim($fields[$i]);
            }
        }

        return $fields;
    }

    // Preview
    public function get_fragrance_review_data()
    {
        // Field names
        $fragrance_review_helper = new Fragrance_Review_Helper();
        $fields = $fragrance_review_helper->get_fragrance_review_data_fields();

        // Calling data
        $all = User_Fragrance_Review::rightJoin('location as ufr_location', 'ufr_location.id', 'user_fragrance_review.location_id')
        ->join('users', 'users.id', 'user_fragrance_review.users_id')
        ->join('fragrance_profile', 'fragrance_profile.users_id', 'users.id')
        
        ->join('profession', 'profession.id', 'fragrance_profile.profession_id')
        ->join('skin_type', 'skin_type.id', 'fragrance_profile.skin_type_id')
        ->join('location as fp_location', 'fp_location.id', 'fragrance_profile.location_id')
        ->join('climate', 'climate.id', 'fragrance_profile.climate_id')
        ->join('season', 'season.id', 'fragrance_profile.season_id')
        
        ->join('fragrance', 'fragrance.id', 'user_fragrance_review.fragrance_id')
        ->join('fragrance_type', 'fragrance_type.id', 'fragrance.type_id')
        
        // ->join('fragrance_ingredient', 'fragrance_ingredient.fragrance_id', 'fragrance.id')
        // ->join('fragrance_accord', 'fragrance_accord.fragrance_id', 'fragrance.id')
        // ->join('ingredient', 'ingredient.id', 'fragrance_ingredient.id')
        // ->join('accord', 'accord.id', 'fragrance_accord.id')

        ->join('fragrance_brand', 'fragrance_brand.id', 'fragrance.brand_id')
        ->join('brand_tier', 'brand_tier.id', 'fragrance_brand.tier_id')
        ->join('location as bo_location', 'bo_location.id', 'fragrance_brand.origin_id')
        
        ->join('fragrance_brand_availability', 'fragrance_brand_availability.brand_id', 'fragrance_brand.id')
        ->join('location as fba_location', 'fba_location.id', 'fragrance_brand_availability.location_id')
        
        ->select($fields)
        ->get();

        // Return
        return $all;
    }

    public function get_fragrance_review_data_preview()
    {
        $fragrance_review_helper = new Fragrance_Review_Helper();
        return $fragrance_review_helper->get_fragrance_review_data()->take(5);
    }




    // public function get_weights()
    // {
    //     return json_encode($this->weights_json);
    // }
}