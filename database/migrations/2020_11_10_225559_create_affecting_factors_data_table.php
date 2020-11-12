<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectingFactorsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affecting_factors_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('model_version_id');
            $table->foreign('model_version_id')->references('id')->on('model_version')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->float('avg_temp')->nullable();
            $table->float('avg_hum')->nullable();
            $table->float('bmi')->nullable();
            $table->string('fragrance_type_condition',30)->nullable();
            $table->float('fragrance_type_weight')->nullable();
            $table->float('sustainability_heat_condition')->nullable();
            $table->float('sustainability_heat_weight')->nullable();
            $table->float('humidity_condition')->nullable();
            $table->float('humidity_weight')->nullable();
            $table->float('warm_cold_condition_1')->nullable();
            $table->string('warm_cold_condition_2',15)->nullable();
            $table->float('warm_cold_weight')->nullable();
            $table->float('sweat_condition_1')->nullable();
            $table->string('sweat_condition_2',15)->nullable();
            $table->float('sweat_weight')->nullable();
            $table->float('bmi_condition')->nullable();
            $table->float('bmi_weight')->nullable();
            $table->string('skin_condition', 20)->nullable();
            $table->float('skin_weight')->nullable();
            $table->string('type',15);
            $table->float('rating');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affecting_factors_data');
    }
}
