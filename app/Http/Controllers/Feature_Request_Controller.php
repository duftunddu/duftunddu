<?php

namespace App\Http\Controllers;

use App\User;
use App\Feature_Request;
use App\Feature_Request_Record;
use Illuminate\Http\Request;

use Carbon\Carbon;

class Feature_Request_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms.request_feature');
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
        // Storing Vote
        
        if(Feature_Request_Record::where('users_id', request()->user()->id)
        ->where('feature_request_id', $request->feature_id)
        ->exists())
        {
            // Already voted    
            echo "Your have already voted.";
        }
        else{
            // Voting now

            Feature_Request_Record::create([
                'feature_request_id'    => $request->feature_id,
                'users_id'              => request()->user()->id,
                'vote_status'           => TRUE,
            ]);

            Feature_Request::find($request->feature_id)
            ->increment('votes', 1);

            echo "Your vote has been recorded.";
        }
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature_Request  $feature_Request
     * @return \Illuminate\Http\Response
     */
    public function show(Feature_Request $feature_Request)
    {
        $date = Carbon::today()->subDays(7);
        $features = Feature_Request::where('status', '!=', "Processed (Added)")
        ->where('feature_request.updated_at', '<', $date)
        ->join('users', 'users.id', 'feature_request.users_id')
        ->select('users.id as user_id', 'users.name as user', 'feature_request.*')
        ->orderBy('votes', 'desc')
        ->get();

        $users_ids = $features->flatten()->pluck('users_id')->toArray();
        
        $users = collect();
        $from = collect();
        foreach ($users_ids as $user_id){
            // $users->push(User::find($user_id));
            if(User::find($user_id)->hasRole('admin')){
                $from->push('staff');
            }
            else{
                $from->push('user');
            }
        }

        return view('forms.request_feature_view',[
            'features'      =>    $features,
            'from'          =>    $from,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature_Request  $feature_Request
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature_Request $feature_Request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature_Request  $feature_Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature_Request $feature_Request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature_Request  $feature_Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature_Request $feature_Request)
    {
        //
    }
}
