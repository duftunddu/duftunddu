<?php

namespace App\Helper;

// use App;
use App\Location;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class Helper
{
    public function __construct() {
        //
    }

    // Normalizers
    public static function normalize_name($name){
        
        if (App::environment('local')) {
            // The environment is local
            $process = new Process([
                'C:\Anaconda3\envs\duft_und_du\python.exe',
                'unidecode_string.py',
                $name
            ], null, [
                'PYTHONHASHSEED' => 1,
            ]);
        }
        else{
            // if (App::environment('production')) {
            // The environment is not local ...
            $process = new Process([
                'python3',
                'unidecode_string.py',
                $name
            ], null, [
                'PYTHONHASHSEED' => 1,
            ]);
        }
      
      $process->run();

      // executes after the command finishes
      if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
      }
      
      $normal_name  = rtrim($process->getOutput());

      return $normal_name;
    }

    public static function var_dump_readable($var){
        echo '<pre>' , var_dump($var) , '</pre>';
        return;
    }

    // Location Helpers
    public static function current_location(){
        return Location::firstWhere('ip_to', '>', ip2long(request()->ip()));
    }

    // Currency Helpers
    public static function currencies(){
        $currencies     =   new ExchangeRate();
        $currencies = $currencies->currencies();
        array_push($currencies,"PKR");
        sort($currencies);
        return $currencies;
    }
    
    public static function currency_convert($cost, $from, $to){
        $exchangeRates = new ExchangeRate();
        $usd_to_pkr = 163.2;

        // If both 'from' and 'to' are PKR then this function won't even be called. 

        if($from == 'PKR'){
            return round($exchangeRates->convert($cost * $usd_to_pkr, 'USD', $to));
        }
        else if($to == 'PKR'){
            return round($exchangeRates->convert($cost, $from, 'USD') * $usd_to_pkr);
        }
        else{
            return round($exchangeRates->convert($cost, $from, $to));
        }
    }

    // Fragrance Helpers
    public static function weather_data($location_id = NULL){
        
        // check if the data exists and if it is old
        if(session()->has('weather') && session('weather_datestamp') == Carbon::now()->format('d')){
            return session('weather');
        }
        else{
            // if location_id is null, find the location.
            $location = ($location_id) ? Location::find($location_id) : current_location();

            // get weather data
            // https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&exclude={part}&appid={API key}
            $weather_data_json  = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,hourly,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");   
            
            // store in session
            session(['weather' => $weather_data_json]);
            session(['weather_datestamp' => Carbon::now()->format('d')]);
            
            return $weather_data_json;
        }
    }

    public static function avg_hum($location_id){
        $location = Location::find($location_id);
          
        // https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&exclude={part}&appid={API key}
        $weather_data_json  = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,hourly,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");
          
        // Helper::var_dump_readable($weather_data_json->successful());return;
        if($weather_data_json->successful()){
            $sum_hum = 0;
            for ($i = 0; $i < 8; $i++){
                $sum_hum  += $weather_data_json['daily'][$i]['humidity'];
            }
        }
        return $sum_hum/8;
    }
    
    public function fragrance_json() {

        $obj = (object) [
            'avg_temp'                      => $weights->avg_temp,
            'avg_hum'                       => $weights->avg_hum,
            'bmi'                           => $weights->bmi,
            'fragrance_type_condition'      => $weights->fragrance_type_weight->condition,
            'fragrance_type_weight'         => $weights->fragrance_type_weight->weight,
            'sustainability_heat_condition' => $weights->sustainability_heat_weight->condition,
            'sustainability_heat_weight'    => $weights->sustainability_heat_weight->weight,
            'humidity_condition'            => $weights->humidity_weight->condition,
            'humidity_weight'               => $weights->humidity_weight->weight,
            'warm_cold_condition_1'         => $weights->warm_cold_weight->condition_1,
            'warm_cold_condition_2'         => $weights->warm_cold_weight->condition_2,
            'warm_cold_weight'              => $weights->warm_cold_weight->weight,
            'sweat_condition_1'             => $weights->sweat_weight->condition_1,
            'sweat_condition_2'             => $weights->sweat_weight->condition_2,
            'sweat_weight'                  => $weights->sweat_weight->weight,
            'bmi_condition'                 => $weights->bmi_weight->condition,
            'bmi_weight'                    => $weights->bmi_weight->weight,
            'skin_condition'                => $weights->skin_weight->condition,
            'skin_weight'                   => $weights->skin_weight->weight,
            'type'                          => $request->type,
            'rating'                        => $request->value,
        ];

        return json_encode($obj);
    }

    // Useless but kept for I don't know what
    // It is said that it Returns a pure array not a stdClass knockoff,
    // I tried and was disappointed but further testing is required
    public static function convert_collection_to_array($array_with_stdClass){
        return array_map( function($value) { return (array)$value; }, $array_with_stdClass );
    }
}