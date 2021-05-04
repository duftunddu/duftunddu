<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;
use App\Fragrance_Profile;
use App\Search_Queries;
use App\Location;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class Search_Queries_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent = new Agent();

        // $all = DB::table('fragrance_brand')->select('name')->map(function($x){ return (array) $x; })->get();
        // $all = Fragrance_Brand::pluck('normal_name')->toArray();       
        // $all = array_merge($all, Fragrance::pluck('normal_name')->toArray());

        // $all = implode (", ", $all);

        // var_dump($all); return;

        if($agent->isDesktop()){
            return view('forms.search_engine');
        }
        else{
            $random = random_int(-1, 1);
            return view('forms.search_engine_m',[
                'random'  =>  $random
            ]);
        }
    }

    public function autocomplete (Request $request) {

        // %string% = searches for substring
        // string% = searches for substring in prefix
        // %string = searches for substring in suffix

        $frag = Fragrance::where("normal_name","LIKE","{$request->to_search}%")
            ->pluck('name')->toArray();

        $brand = Fragrance_Brand::where("normal_name","LIKE","{$request->to_search}%")
            ->pluck('name')->toArray();

        $data = array_merge($frag, $brand);

        return $data;
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
        $validatedData  =   $request->validate([
            'searchbox' =>  'required|max:40',
        ]);

        $words = explode(' ', $request->searchbox);
        $regex = implode('|', $words);

        $results = DB::table('fragrance')
            ->join('fragrance_brand', 'fragrance_brand.id', '=', 'fragrance.brand_id')
            ->where('fragrance.name', 'regexp', $regex)
            ->orWhere('fragrance_brand.name', 'regexp', $regex)
            ->select('fragrance.id as f_id','fragrance.name as f_name', 'fragrance_brand.id as b_id','fragrance_brand.name as b_name')
            ->paginate(10);

        $params = ['searchbox' => $request->searchbox];    

        if($request->page == NULL){
            
            // Page refresh check
            $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
 
            if(!$pageWasRefreshed) {
            //page wasn't refreshed
                $location = Location::firstWhere('ip_to', '>', ip2long(request()->ip()));

                $agent = new Agent();

                DB::transaction(function () use ($request, $location, $agent) {
                    $new = new Search_Queries();
                    $new->query = $request->searchbox;
                    $new->location_id     = $location->id;
                    $new->device              = $agent->device();
                    $new->platform            = $agent->platform();
                    $new->browser             = $agent->browser();
                    $new->version             = $agent->version($agent->browser());
                    $new->desktop             = $agent->isDesktop();
                    $new->phone               = $agent->isPhone();
                    $new->tablet              = $agent->isTablet();

                    if (Auth::check()) {
                        if(request()->user()->hasRole('user')){
                            $profile = Fragrance_Profile::where('users_id', request()->user()->id)->first();
                            
                            $new->users_id        = $profile->users_id;
                            $new->gender          = $profile->gender;
                            $date                 = Carbon::parse($profile->dob);

                            $new->age             = Carbon::now()->diffInYears($date);
                            $new->profession_id   = $profile->profession_id;
                            $new->skin_type_id    = $profile->skin_type_id;
                            $new->sweat           = $profile->sweat;
                            $new->height          = $profile->height;
                            $new->weight          = $profile->weight;
                            $new->climate_id      = $profile->climate_id;
                            $new->season_id       = $profile->season_id;
                        }
                    }

                    $new->save();
                });
            } else {
                //page was refeshed
            }
        }

        return view('forms.search_results',[
            'query'     =>  $request->searchbox,
            'results'   =>  $results,
            'params'    =>  $params
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Search_Queries  $search_Queries
     * @return \Illuminate\Http\Response
     */
    public function show(Search_Queries $search_Queries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Search_Queries  $search_Queries
     * @return \Illuminate\Http\Response
     */
    public function edit(Search_Queries $search_Queries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Search_Queries  $search_Queries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search_Queries $search_Queries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Search_Queries  $search_Queries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search_Queries $search_Queries)
    {
        //
    }
}
