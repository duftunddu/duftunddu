<?php

namespace App\Http\Controllers;

use App\Feature_Request_By_User;
use Illuminate\Http\Request;

class Feature_Request_By_User_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Only one request is allowed at a time
        if(Feature_Request_By_User::where('users_id', request()->user()->id)->exists()){
            $allowed = FALSE;
        }
        else{
            $allowed = TRUE;
        }
        return view('forms.request_feature_by_user', ['allowed'=> $allowed]);
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
            'name'              => 'required|max:40',
            'description'       => 'required|max:256',
            'implementation'    => 'max:500',
        ]);
        
        Feature_Request_By_User::create([
            'users_id'          => request()->user()->id,
            'name'              => $request->input('name'),
            'description'       => $request->input('description'),
            'implementation'    => $request->input('implementation'),
        ]);

        return redirect('home')->with('success','Your request has been queued for processing. Thank you for contributing.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature_Request_By_User  $feature_Request_By_User
     * @return \Illuminate\Http\Response
     */
    public function show(Feature_Request_By_User $feature_Request_By_User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature_Request_By_User  $feature_Request_By_User
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature_Request_By_User $feature_Request_By_User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature_Request_By_User  $feature_Request_By_User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature_Request_By_User $feature_Request_By_User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature_Request_By_User  $feature_Request_By_User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature_Request_By_User $feature_Request_By_User)
    {
        //
    }
}
