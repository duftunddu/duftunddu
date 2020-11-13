<?php

namespace App\Http\Controllers;

use Auth;
use App\Feedback;
use App\Feedback_Type;
use App\Feedback_Comment;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

class Feedback_Comment_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Feedback_Type::all();
        return view('forms.feedback_entry', [ 'types' => $types ]);
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
            'type_id'       => 'required',
            'comment'       => 'required|max:300',
        ]);

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
            $new                        = new feedback_comment();
            $new->feedback_id           = $feedback_id;
            $new->feedback_type_id      = $request->input('type_id');
            $new->comment               = $request->input('comment');
            
            $new->save();

        });

        return redirect('search_engine')->with('success','Thank your for your feedback.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback_Comment  $feedback_Comment
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback_Comment $feedback_Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback_Comment  $feedback_Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback_Comment $feedback_Comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback_Comment  $feedback_Comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback_Comment $feedback_Comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback_Comment  $feedback_Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback_Comment $feedback_Comment)
    {
        //
    }
}
