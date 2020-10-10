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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();
        $fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->get();

        if(!empty($fragrances)){

            $date = Carbon::today()->subDays(7);
            $only_fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->pluck('normal_name');
            $queries = Search_Queries::where('created_at', '>=', $date)
                ->where('query', '=', $only_fragrances)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->get();
        }

        // var_dump($queries->pluck('count'));return;
        // var_dump($queries[0]->count);return;
        // var_dump($queries[0]->date);return;
        // var_dump($queries);
        // return;

        $dates = $queries->pluck('date');
        $counts = $queries->pluck('count');
        
        return view('brand_ambassador.home',[
            'ambassador'   => $ambassador,
            'fragrances'   => $fragrances,
            'queries_data' => $queries,
            'dates'        => $dates,
            'counts'       => $counts
        ]);
    }

    public function advertise()
    {
        $ambassador = Brand_Ambassador_Profile::where('users_id', request()->user()->id)->first();
        $fragrances = Fragrance::where('brand_id', $ambassador->brand_id)->get();

        if(!empty($fragrances)){

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
