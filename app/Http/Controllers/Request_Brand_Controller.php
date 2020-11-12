<?php

namespace App\Http\Controllers;

use App\Request_Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class Request_Brand_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.request_brand');
    }
    
    public function vote(Request $request){
        // echo $request->value;
        // echo $request->brand_name;
        
        Request_Brand::where('name', $request->brand_name)
        ->increment('votes', 1);

        echo "Your vote has been recorded.";
        return;
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
            'name'            => 'required|unique:Fragrance_Brand|unique:Request_Brand',
            'website'         => 'required',
          ]);
   
         DB::transaction(function () use ($request) {
            
            $new                    = new request_brand();
            $new->users_id          = request()->user()->id;
            $new->name              = $request->input('name');
            $new->website           = $request->input('website');
            $new->status            = "Queued";
            $new->votes             = 1;
            
            $new->save();
         });
         
         return redirect('request_brand_view')->with('success','Brand Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request_Brand  $request_Brand
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $date = Carbon::today()->subDays(7);
        $brands = Request_Brand::where('status', '!=', "Processed (Added)")
        ->where('request_brand.updated_at', '>', $date)
        ->join('users', 'users.id', 'request_brand.users_id')
        ->select('users.name as user', 'request_brand.*')
        ->orderBy('votes', 'desc')
        ->get();

        return view('forms.request_brand_view',[
            'brands'        =>    $brands,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request_Brand  $request_Brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request_Brand $request_Brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Request_Brand  $request_Brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request_Brand $request_Brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request_Brand  $request_Brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request_Brand $request_Brand)
    {
        //
    }
}
