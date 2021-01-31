<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;
use App\Brand_Ambassador_Profile;

use App\Search_Queries;
use Carbon\Carbon;

use App\Accord;
use App\Fragrance_Type;
use App\Fragrance_Accord;
use App\Fragrance_Ingredient;
use App\Ingredient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Brand_Ambassador_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        // 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambassador = Brand_Ambassador_Profile::firstWhere('users_id', request()->user()->id);
        $fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->get();

        // fetching the search counts for the past week
        if($fragrances->isNotEmpty()){
            // Taking fragrances names
            $only_fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->select(DB::raw("CONCAT(fragrance.name,' ',fragrance.normal_name) as frag"))->pluck('frag');
            // ->get();
    
            // Creating regex for query
            $words = [];
            foreach($only_fragrances as $fragrance_name){
                $words =  array_merge($words, explode(' ', $fragrance_name));
            }
            $words = array_unique($words);
            $regex = implode('|', $words);

            // Seraching through queries
            $date = Carbon::today()->subDays(6);
            $queries = Search_Queries::where('created_at', '>=', $date)
                ->where('query', 'regexp', $regex)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date',)
                ->orderBy('date', 'asc')
                ->get();

            $dates          = $queries->pluck('date')->toArray();
            $fetched_counts = $queries->pluck('count')->toArray();

            // Filling the rest of the days
            $week_count = array(0,0,0,0,0,0,0);
            
            $j = 0;
            for($i=0; $i < 7; $i++){
                if(count($dates) < $j+1){
                    break;
                }

                if($date->toDateString() == $dates[$j]){
                    $week_count[$i] = $fetched_counts[$j];
                    $j++;
                }
                $date->addDays(1);
            }
            
            $max = max($week_count);
            if($max%10 != 0){
                $yaxis_limit = $max + (10 - $max%10); 
            }
            else if ($max == 0){
                $yaxis_limit = 10;
            }
            else{
                $yaxis_limit = $max;
            }    
        }
        else{
            $queries = NULL;
            $week_count = NULL;
            $yaxis_limit = 5;
        }
        
        return view('brand_ambassador.home',[
            'ambassador'        => $ambassador,
            'fragrances'        => $fragrances,
            'queries_data'      => $queries,
            'counts'            => $week_count,
            'yaxis_limit'       => $yaxis_limit
        ]);
    }

    public function advertise()
    {
        $ambassador = Brand_Ambassador_Profile::firstWhere('users_id', request()->user()->id);
        $fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->get();

        if(!is_null($fragrances)){
            $date = Carbon::today()->subDays(7);
            $only_fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->pluck('normal_name');
            $queries = Search_Queries::where('created_at', '>=', $date)
                ->where('query', '=', $only_fragrances)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->get();
        }

        // var_dump($queries[0]->count);return;
        
        return view('brand_ambassador.home',[
            'ambassador'        => $ambassador,
            'fragrances'        => $fragrances,
            'queries_data'      => $queries
        ]);
    }
}
