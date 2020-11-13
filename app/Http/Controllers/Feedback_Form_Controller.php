<?php

namespace App\Http\Controllers;

use Auth;
use App\Feedback;
use App\Feedback_Form;
use App\Feedback_Type;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

class Feedback_Form_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types =Feedback_Type::all();
        return view('forms.feedback');
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
        $agent = new Agent();

        DB::transaction(function () use ($request, $agent) {
    
            // Feedback
            $new                      = new feedback();
            if(Auth::check()){
                $new->users_id        = request()->user()->id;
            }
            $new->device              = $agent->device();
            $new->platform            = $agent->platform();
            $new->browser             = $agent->browser();
            $new->version             = $agent->version($agent->browser());
            $new->desktop             = $agent->isDesktop();
            $new->phone               = $agent->isPhone();
            $new->tablet              = $agent->isTablet();
            
            $new->save();
        
            $feedback_id = $new->id;
            
            // Feedback Form
            $new                    = new feedback_form();
            $new->feedback_id       = $feedback_id;
            $new->user_interface    = $request->input('ui');
            $new->functionality     = $request->input('function');
            $new->recommend         = $request->input('recommend');
            
            $new->save();

        });

        return redirect('search_engine')->with('success','Thank your for your feedback.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback_Form  $feedback_Form
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback_Form $feedback_Form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback_Form  $feedback_Form
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback_Form $feedback_Form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback_Form  $feedback_Form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback_Form $feedback_Form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback_Form  $feedback_Form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback_Form $feedback_Form)
    {
        //
    }
}
