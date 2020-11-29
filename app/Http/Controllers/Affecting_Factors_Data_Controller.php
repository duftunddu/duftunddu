<?php namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Location;
use App\Model_Version;
use App\Affecting_Factors_Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Affecting_Factors_Data_Controller extends Controller {

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
        // TODO: Change this to whatever the new thing is:
        $model_version = Model_Version::where('type', 'affecting_factors')->latest()->first();

        $location=Helper::current_location();
        $weights=json_decode($request->weights);

        $matchThese=[ 'users_id'=>request()->user()->id,
            'model_version_id'  =>$model_version->id,
            'location_id'       =>$location->id,
            'type'              =>$request->type,
        ];

        Affecting_Factors_Data::updateOrCreate($matchThese, [
            'avg_temp'                      => $weights->avg_temp,
            'avg_hum'                       => $weights->avg_hum,
            'bmi'                           => $weights->bmi,
            'fragrance_type_condition'      => $weights->fragrance_type_weight->condition,
            'fragrance_type_weight'         => $weights->fragrance_type_weight->weight,
            'sustainability_heat_condition' => $weights->sustainability_heat_weight->condition,
            'sustainability_heat_weight'    => $weights->sustainability_heat_weight->weight,
            'humidity_condition'            => $weights->humidity_weight->condition,
            'humidity_weight'               => $weights->humidity_weight->weight,
            'warm_cold_condition_1'         => $weights->warm_cold_weight->condition_1,
            'warm_cold_condition_2'         => $weights->warm_cold_weight->condition_2,
            'warm_cold_weight'              => $weights->warm_cold_weight->weight,
            'sweat_condition_1'             => $weights->sweat_weight->condition_1,
            'sweat_condition_2'             => $weights->sweat_weight->condition_2,
            'sweat_weight'                  => $weights->sweat_weight->weight,
            'bmi_condition'                 => $weights->bmi_weight->condition,
            'bmi_weight'                    => $weights->bmi_weight->weight,
            'skin_condition'                => $weights->skin_weight->condition,
            'skin_weight'                   => $weights->skin_weight->weight,
            'type'                          => $request->type,
            'rating'                        => $request->value,

        ]);

        echo "Thank you for your feedback";
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affecting_Factors_Data  $affecting_Factors_Data
     * @return \Illuminate\Http\Response
     */
    public function show(Affecting_Factors_Data $affecting_Factors_Data) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affecting_Factors_Data  $affecting_Factors_Data
     * @return \Illuminate\Http\Response
     */
    public function edit(Affecting_Factors_Data $affecting_Factors_Data) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affecting_Factors_Data  $affecting_Factors_Data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affecting_Factors_Data $affecting_Factors_Data) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affecting_Factors_Data  $affecting_Factors_Data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affecting_Factors_Data $affecting_Factors_Data) {
        //
    }
}