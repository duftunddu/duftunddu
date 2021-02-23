<?php namespace App\Helper;

// To Remove Accents
use App;

use App\Location;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class Helper {
    public function __construct() {
        //
    }

    // Normalizers
    public static function remove_accents($name) {

        if (App::environment('local')) {
            // The environment is local
            $process=new Process([ 'C:\Anaconda3\envs\duft_und_du\python.exe', 'unidecode_string.py',
                $name], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }
        else {
            // if (App::environment('production')) {
            // The environment is not local ...
            $process=new Process([ 'python3', 'unidecode_string.py',
                $name], null, [ 'PYTHONHASHSEED'=> 1, ]);
        }

        $process->run();

        // executes after the command finishes
        if ( !$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $normal_name=rtrim($process->getOutput());

        return $normal_name;
    }

    public static function var_dump_readable($var) {
        echo '<pre>',
        var_dump($var),
        '</pre>';
        return;
    }


    // Location Helpers
    public static function current_location() {
        return Location::firstWhere('ip_to', '>', ip2long(request()->ip()));
    }

    public static function get_location() {
        return Location::firstWhere('ip_to', '>', ip2long(request()->ip()));
    }


    // Currency Helpers
    public static function currencies() {
        $currencies=new ExchangeRate();
        $currencies=$currencies->currencies();
        array_push($currencies, "PKR");
        sort($currencies);
        return $currencies;
    }

    public static function convert_currency($cost, $from, $to) {
        // If both 'from' and 'to' are PKR then this function won't even be called.
        $exchangeRates=new ExchangeRate();
        $usd_to_pkr=163.2;

        if($from=='PKR') {
            return round($exchangeRates->convert($cost * $usd_to_pkr, 'USD', $to));
        }
        else if($to=='PKR') {
            return round($exchangeRates->convert($cost, $from, 'USD') * $usd_to_pkr);
        }
        else {
            return round($exchangeRates->convert($cost, $from, $to));
        }
    }


    // Weather Helpers
    public static function get_weather_data($location_id=NULL) {

        // For debugging:
        // session()->forget('weather');

        // check if the data exists and if it is old
        if(session()->has('weather') && session('weather_datestamp')==Carbon::now()->format('d')) {
            return session('weather');
        }

        else {
            return Helper::set_weather_data($location_id);
        }
    }

    private static function set_weather_data($location_id=NULL) {
        // if location_id is null, find the location.
        $location=($location_id) ? Location::find($location_id): Helper::current_location();
        // For debugging, comment the upper one and use the below one:
        // $location = Location::find(2);

        // get weather data
        // https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&exclude={part}&appid={API key}
        // $weather_data_json  = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,hourly,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");   
        $weather_data_json=  Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");
        $weather_data = json_decode($weather_data_json);

        // store in session
        session(['weather'=> $weather_data]);
        session(['weather_datestamp'=> Carbon::now()->format('d')]);
        session(['weather_success'=> $weather_data_json->successful()]);

        return $weather_data;
    }

    public static function get_weather_success($location_id=NULL) {

        // check if the data exists
        if(session()->has('weather_success')) {
            return session('weather_success');
        }

        else {
            Helper::set_weather_data($location_id);
            return Helper::get_weather_success($location_id);
        }
    }

    public static function get_weather_average_data($location_id=NULL) {
        // For debugging
        // Helper::var_dump_readable($weather_data); return;
        // session()->forget('weather_avg');

        // check if the data exists
        if(session()->has('weather_avg')) {
            return session('weather_avg');
        }
        else {
            return Helper::set_weather_average_data($location_id);
        }
    }

    private static function set_weather_average_data($location_id=NULL) {
        $weather_data = Helper::get_weather_data();

        if( !Helper::get_weather_success() ) {
            return FALSE;
        }

        $weather_average=(object) [
            'temp'                  =>      NULL,
            'hum'                   =>      NULL,
            'dew_point'             =>      NULL,
            'uv_index'              =>      NULL,
            'temp_feels_like'       =>      NULL,
            'atm_pressure'          =>      NULL,
            'clouds'                =>      NULL,
            'visibility'            =>      NULL,
            'wind_speed'            =>      NULL,
            'rain'                  =>      NULL,
            'snow'                  =>      NULL,
            'weather_main'          =>      NULL,
            'weather_desc'          =>      NULL,
        ];

        // Initialization of Arrays
        $weather_main_array=[];
        $weather_desc_array=[];

        // Sum of Weekly stats for Avg
        // Daily
        for ($i=0; $i < 8; $i++) {
            $weather_average->temp                  +=      $weather_data->daily[$i]->temp->day;
            $weather_average->hum                   +=      $weather_data->daily[$i]->humidity;
            $weather_average->dew_point             +=      $weather_data->daily[$i]->dew_point;
            $weather_average->uv_index              +=      $weather_data->daily[$i]->uvi;
            $weather_average->temp_feels_like       +=      $weather_data->daily[$i]->feels_like->day;
            $weather_average->atm_pressure          +=      $weather_data->daily[$i]->pressure;
            $weather_average->clouds                +=      $weather_data->daily[$i]->clouds;
            $weather_average->wind_speed            +=      $weather_data->daily[$i]->wind_speed;

            if (isset($weather_data->daily[$i]->rain)) {
                $weather_average->rain+=$weather_data->daily[$i]->rain;
            }

            if (isset($weather_data->daily[$i]->snow)) {
                $weather_average->snow+=$weather_data->daily[$i]->snow;
            }

            array_push($weather_main_array, $weather_data->daily[$i]->weather[0]->main);
            array_push($weather_desc_array, $weather_data->daily[$i]->weather[0]->description);
        }

        // Hourly
        for ($i=0; $i < 48; $i++) {
            $weather_average->visibility            +=      $weather_data->hourly[$i]->visibility;
        }

        // Average
        $weather_average->temp               /=     8;
        $weather_average->hum                /=     8;
        $weather_average->dew_point          /=     8;
        $weather_average->uv_index           /=     8;
        $weather_average->temp_feels_like    /=     8;
        $weather_average->atm_pressure       /=     8;
        $weather_average->clouds             /=     8;
        $weather_average->visibility         /=     8;
        $weather_average->wind_speed         /=     8;
        $weather_average->rain               /=     8;
        $weather_average->snow               /=     8;

        // Mode: Weather Main
        $weather_main_array_values = array_count_values($weather_main_array);
        $weather_average->weather_main = array_search(max($weather_main_array_values), $weather_main_array_values);
        // Mode: Weather Description
        $weather_desc_array_values = array_count_values($weather_desc_array);
        $weather_average->weather_desc = array_search(max($weather_desc_array_values), $weather_desc_array_values);

        // Store in session
        session(['weather_avg'=> $weather_average]);

        return $weather_average;
    }

    
    
    public function fragrance_json() {

        $obj=(object) [ 'avg_temp'=>$weights->avg_temp,
        'avg_hum'=>$weights->avg_hum,
        'bmi'=>$weights->bmi,
        'fragrance_type_condition'=>$weights->fragrance_type_weight->condition,
        'fragrance_type_weight'=>$weights->fragrance_type_weight->weight,
        'sustainability_heat_condition'=>$weights->sustainability_heat_weight->condition,
        'sustainability_heat_weight'=>$weights->sustainability_heat_weight->weight,
        'humidity_condition'=>$weights->humidity_weight->condition,
        'humidity_weight'=>$weights->humidity_weight->weight,
        'warm_cold_condition_1'=>$weights->warm_cold_weight->condition_1,
        'warm_cold_condition_2'=>$weights->warm_cold_weight->condition_2,
        'warm_cold_weight'=>$weights->warm_cold_weight->weight,
        'sweat_condition_1'=>$weights->sweat_weight->condition_1,
        'sweat_condition_2'=>$weights->sweat_weight->condition_2,
        'sweat_weight'=>$weights->sweat_weight->weight,
        'bmi_condition'=>$weights->bmi_weight->condition,
        'bmi_weight'=>$weights->bmi_weight->weight,
        'skin_condition'=>$weights->skin_weight->condition,
        'skin_weight'=>$weights->skin_weight->weight,
        'type'=>$request->type,
        'rating'=>$request->value,
        ];

        return json_encode($obj);
    }

    // Useless but kept for I don't know what
    // It is said that it Returns a pure array not a stdClass knockoff,
    // I tried and was disappointed but further testing is required
    public static function convert_collection_to_array($array_with_stdClass) {
        return array_map(function($value) {
                return (array)$value;
            }

            , $array_with_stdClass);
    }
}