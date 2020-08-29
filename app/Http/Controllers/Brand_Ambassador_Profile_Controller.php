<?php namespace App\Http\Controllers;

use App\Brand_Ambassador_Profile;
use Illuminate\Http\Request;

use App\Helper\Helper;

class Brand_Ambassador_Profile_Controller extends Controller {
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand_Ambassador_Profile  $brand_Ambassador_Profile
     * @return \Illuminate\Http\Response
     */
    public function show(Brand_Ambassador_Profile $brand_Ambassador_Profile) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand_Ambassador_Profile  $brand_Ambassador_Profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand_Ambassador_Profile $brand_Ambassador_Profile) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand_Ambassador_Profile  $brand_Ambassador_Profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand_Ambassador_Profile $brand_Ambassador_Profile) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand_Ambassador_Profile  $brand_Ambassador_Profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand_Ambassador_Profile $brand_Ambassador_Profile) {
        //
    }
}