<?php

namespace App\Helper;

// To Remove Accents
use App;

// For exchange rates
use Cache;

use App\Store;
use App\Store_Stock;

use App\Location;

use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Http;

class Helper
{
    public function __construct()
    {
        //
    }



    // Normalizers
    public static function remove_accents($name)
    {

        if (App::environment('local')) {
            // The environment is local
            // $process=new Process([ 'C:\Anaconda3\envs\duft_und_du\python.exe', 'python_scripts\unidecode_string.py',
            $process = new Process([
                'C:\Anaconda3\envs\duft_und_du\python.exe', 'unidecode_string.py',
                $name
            ], null, ['PYTHONHASHSEED' => 1,]);
        } else {
            // if (App::environment('production')) {
            // The environment is not local ...
            // $process=new Process([ 'python3', 'python_scripts\unidecode_string.py',
            $process = new Process([
                'python3', 'unidecode_string.py',
                $name
            ], null, ['PYTHONHASHSEED' => 1,]);
        }

        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $normal_name = rtrim($process->getOutput());

        return $normal_name;
    }

    public static function var_dump_readable($var)
    {
        echo '<pre>',
        var_dump($var),
        '</pre>';
        return;
    }



    // Location Helpers
    public function get_current_location()
    {
        return Location::firstWhere('ip_to', '>', ip2long(request()->ip()));
    }



    // Currency Helpers
    // The set function is public cause the scheduler uses it
    public static function set_currency_exchange_rates()
    {
        // Making the call
        // nbu = National Bank of Ukraine
        // $req_url = 'https://api.exchangerate.host/latest?base=USD&places=2&source=nbu';
        // Forex. Currently using forex cause it supports more currencies
        $req_url = 'https://api.exchangerate.host/latest?base=USD&places=2';

        $response = json_decode(file_get_contents($req_url));

        // Saving the response
        Cache::put('currency_data_success', $response->success);

        if ($response->success) {
            Cache::put('currency_data', $response);
            return $response;
        } else {
            return FALSE;
        }
    }

    public static function get_currency_exchange_rates()
    {
        // Checking success
        if (Cache::get('currency_data_success')) {
            return Cache::get('currency_data');
        } else {
            return Helper::set_currency_exchange_rates();
        }
    }


    public static function get_currencies()
    {
        $currencies = Helper::get_currency_exchange_rates();
        // $currencies = (array) $currencies->rates;

        // $currencies = array_keys($currencies);
        $currencies = ['USD', 'PKR'];

        return $currencies;
    }

    public static function convert_currency($cost, $from, $to)
    {
        // If both 'from' and 'to' are PKR then this function won't even be called.
        // $exchangeRates = new ExchangeRate();
        // $usd_to_pkr = 155;

        // Easy solvers
        if ($cost == NULL || $from == NULL || $to == NULL) {
            return NULL;
        } else if ($from == $to) {
            return $cost;
        }

        // Actul solvers
        $rates = Cache::get('currency_data')->rates;

        if ($from == 'USD') {
            $converted = $rates->$to * $cost;
        } else if ($to == 'USD') {
            $converted = 1 / $rates->$from * $cost;
        } else {
            // Algo
            // Convert 57 EUR to PKR
            // 1 USD = 0.9 EUR (from)
            // 1 USD = 153.18 PKR (to)

            // 1 EUR = (1/ 0.9 EUR) USD
            // 1 EUR = 1.11 USD
            // 57 EUR = 63.33 USD

            // 63.33 USD = 63.33 * 153.18 PKR
            // 63.33 USD = 9700.88 PKR
            // return 9700.88


            // Implementation
            // Converted = (In USD) * ($to)
            $converted =  (1 / $rates->$from * $cost) * ($rates->$to);
        }
        // return $converted;
        return round($converted, 1);
    }



    // Weather Helpers
    public static function get_weather_data($location_id = NULL)
    {

        // For debugging:
        // session()->forget('weather');

        // check if the data exists and if it is old
        if (session()->has('weather') && session('weather_datestamp') == Carbon::now()->format('d')) {
            return session('weather');
        } else {
            return Helper::set_weather_data($location_id);
        }
    }

    private static function set_weather_data($location_id = NULL)
    {
        // if location_id is null, find the location.
        $helper = new Helper();
        $location = ($location_id) ? Location::find($location_id) : $helper->get_current_location();
        // For debugging, comment the upper one and use the below one:
        // $location = Location::find(2);

        // get weather data
        // https://api.openweathermap.org/data/2.5/onecall?lat={lat}&lon={lon}&exclude={part}&appid={API key}
        // $weather_data_json  = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,hourly,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");
        $weather_data_json =  Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$location->latitude}&lon={$location->longitude}&units=imperial&exclude=current,minutely,alerts&appid=7120811d6e66b35f6be4b030be29c4d3");
        $weather_data = json_decode($weather_data_json);

        // store in session
        session(['weather' => $weather_data]);
        session(['weather_datestamp' => Carbon::now()->format('d')]);
        session(['weather_success' => $weather_data_json->successful()]);

        return $weather_data;
    }


    public static function get_weather_success($location_id = NULL)
    {

        // check if the data exists
        if (session()->has('weather_success')) {
            return session('weather_success');
        } else {
            Helper::set_weather_data($location_id);
            return Helper::get_weather_success($location_id);
        }
    }

    public static function get_weather_average_data($location_id = NULL)
    {
        // For debugging
        // Helper::var_dump_readable($weather_data); return;
        // session()->forget('weather_avg');

        // check if the data exists
        if (session()->has('weather_avg')) {
            return session('weather_avg');
        } else {
            return Helper::set_weather_average_data($location_id);
        }
    }

    private static function set_weather_average_data($location_id = NULL)
    {
        $weather_data = Helper::get_weather_data();

        if (!Helper::get_weather_success()) {
            return FALSE;
        }

        $weather_average = (object) [
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
        $weather_main_array = [];
        $weather_desc_array = [];

        // Sum of Weekly stats for Avg
        // Daily
        for ($i = 0; $i < 8; $i++) {
            $weather_average->temp                  +=      $weather_data->daily[$i]->temp->day;
            $weather_average->hum                   +=      $weather_data->daily[$i]->humidity;
            $weather_average->dew_point             +=      $weather_data->daily[$i]->dew_point;
            $weather_average->uv_index              +=      $weather_data->daily[$i]->uvi;
            $weather_average->temp_feels_like       +=      $weather_data->daily[$i]->feels_like->day;
            $weather_average->atm_pressure          +=      $weather_data->daily[$i]->pressure;
            $weather_average->clouds                +=      $weather_data->daily[$i]->clouds;
            $weather_average->wind_speed            +=      $weather_data->daily[$i]->wind_speed;

            if (isset($weather_data->daily[$i]->rain)) {
                $weather_average->rain += $weather_data->daily[$i]->rain;
            }

            if (isset($weather_data->daily[$i]->snow)) {
                $weather_average->snow += $weather_data->daily[$i]->snow;
            }

            array_push($weather_main_array, $weather_data->daily[$i]->weather[0]->main);
            array_push($weather_desc_array, $weather_data->daily[$i]->weather[0]->description);
        }

        // Hourly
        for ($i = 0; $i < 48; $i++) {
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
        session(['weather_avg' => $weather_average]);

        return $weather_average;
    }


    //Stores Helper

    public function is_stock_empty($store_type, $store_id = NULL)
    {
        // If the stock is empty, don't let them go to profile.

        if (is_null($store_id)) {
            $frag_id = Store_Stock::where('store_id', Store::where('users_id', request()->user()->id)->where($store_type, TRUE)->first()->id)
                ->where('available', TRUE)
                ->exists();
        } else {
            $frag_id = Store_Stock::where('store_id', $store_id)
                ->where('available', TRUE)
                ->exists();
        }


        return !$frag_id;
    }

    // Webstore Helper
    public function api_key()
    {

        do {
            $api_key = Helper::secure_random_string();
        } while (Store::where('api_key', $api_key)->exists());

        return $api_key;
    }

    private static function secure_random_string()
    {
        $length = 40;
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }

        return $random_string;
    }



    // Probably unused, check first, then delete
    public function fragrance_json()
    {

        $obj = (object) [
            'avg_temp' => $weights->avg_temp,
            'avg_hum' => $weights->avg_hum,
            'bmi' => $weights->bmi,
            'fragrance_type_condition' => $weights->fragrance_type_weight->condition,
            'fragrance_type_weight' => $weights->fragrance_type_weight->weight,
            'sustainability_heat_condition' => $weights->sustainability_heat_weight->condition,
            'sustainability_heat_weight' => $weights->sustainability_heat_weight->weight,
            'humidity_condition' => $weights->humidity_weight->condition,
            'humidity_weight' => $weights->humidity_weight->weight,
            'warm_cold_condition_1' => $weights->warm_cold_weight->condition_1,
            'warm_cold_condition_2' => $weights->warm_cold_weight->condition_2,
            'warm_cold_weight' => $weights->warm_cold_weight->weight,
            'sweat_condition_1' => $weights->sweat_weight->condition_1,
            'sweat_condition_2' => $weights->sweat_weight->condition_2,
            'sweat_weight' => $weights->sweat_weight->weight,
            'bmi_condition' => $weights->bmi_weight->condition,
            'bmi_weight' => $weights->bmi_weight->weight,
            'skin_condition' => $weights->skin_weight->condition,
            'skin_weight' => $weights->skin_weight->weight,
            'type' => $request->type,
            'rating' => $request->value,
        ];

        return json_encode($obj);
    }

    // Useless but kept for I don't know what
    // It is said that it Returns a pure array not a stdClass knockoff,
    // I tried and was disappointed but further testing is required
    public static function convert_collection_to_array($array_with_stdClass)
    {
        return array_map(
            function ($value) {
                return (array)$value;
            },
            $array_with_stdClass
        );
    }
}
