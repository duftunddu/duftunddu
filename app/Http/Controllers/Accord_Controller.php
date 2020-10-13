<?php namespace App\Http\Controllers;

use App\Accord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Accord_Controller extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.accord_entry');
    }

    public function index_ba() {
        return view('brand_ambassador.accord_entry');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request->validate([ 
            'name'=> 'required|unique:accord',
        ]);

        DB::transaction(function () use ($request) {

                $new=new Accord();
                $new->name=$request->input('name');
                $new->created_by=request()->user()->id;

                $new->save();
        });

        return redirect('accord_entry')->with('success', 'Accord added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accord  $accord
     * @return \Illuminate\Http\Response
     */
    public function show(Accord $accord) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accord  $accord
     * @return \Illuminate\Http\Response
     */
    public function edit(Accord $accord) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accord  $accord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accord $accord) {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accord  $accord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accord $accord) {
        //
    }

    // /**
    //  * Get custom attributes for validator errors.
    //  *
    //  * @return array
    // */
    // public function attributes()
    // {
    //     return [
    //         'name' => 'accord',
    //     ];
    // }
}