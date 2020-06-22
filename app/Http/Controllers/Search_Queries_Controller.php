<?php

namespace App\Http\Controllers;

use App\Fragrance;
use App\Fragrance_Brand;
use App\Search_Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Search_Queries_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Desktop
        return view('forms.search_engine');

        // Mobile
        // return view('forms.search_engine_m');

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
        // $var = Model::where('column', 'ilike', '%' . $request . '%');
        // $brands = DB::table('fragrance_brand')->get();

        // $brands = Fragrance_Brand::where('name', 'ilike', '%' . $request . '%');
        // $fragrances = Fragrance::where('name', 'ilike', '%' . $request . '%');

        $query = $request->searchbox;
        $queries =  preg_split('/ +/', $query, null, PREG_SPLIT_NO_EMPTY);
        
        $brands = DB::table('fragrance_brand')->where('name', '=', $queries[0])->get();
        $fragrances = DB::table('fragrance')->where('name', '=', $queries[0])->get();
        
        unset($queries[0]);  

        foreach($queries as $q) {
            $brands = $brands -> merge(DB::table('fragrance_brand')->where('name', '=', $q)->get());
            $fragrances = $fragrances -> merge(DB::table('fragrance')->where('name', '=', $q)->get());    
        }

        return view('forms.search_results',[
            'brands'      =>  $brands,
            'fragrances'  =>  $fragrances
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
