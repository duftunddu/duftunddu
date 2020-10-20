<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;
use App\Fragrance_Profile;
use App\Search_Queries;

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

        $queries = explode(' ', $request->searchbox);
        
        $results = DB::table('fragrance')
            ->join('fragrance_brand', 'fragrance_brand.id', '=', 'fragrance.brand_id')
            ->whereIn('fragrance.name', $queries)
            ->select('fragrance.id as f_id','fragrance.name as f_name', 'fragrance_brand.id as b_id','fragrance_brand.name as b_name')
            ->paginate(10);

        $params = ['searchbox' => $request->searchbox];
    
        if($request->page == NULL){
        
            DB::transaction(function () use ($request) {
                $new = new Search_Queries();
                $new->query = $request->searchbox;

                if (Auth::check()) {
                    if(request()->user()->hasRole('user')){
                        $profile = Fragrance_Profile::where('users_id', request()->user()->id)->first();
                        
                        $new->users_id        = $profile->users_id;
                        $new->gender          = $profile->gender;
                        $new->dob             = $profile->dob;
                        $date                 = Carbon::parse($profile->dob);

                        $new->age             = Carbon::now()->diffInYears($date);
                        $new->profession_id   = $profile->profession_id;
                        $new->skin_type_id    = $profile->skin_type_id;
                        $new->sweat           = $profile->sweat;
                        $new->height          = $profile->height;
                        $new->weight          = $profile->weight;
                        $new->country_id      = $profile->country_id;
                        $new->city_id         = $profile->city_id;
                        $new->climate_id      = $profile->climate_id;
                        $new->season_id       = $profile->season_id;
                    }
                }

                $new->save();
            });
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
