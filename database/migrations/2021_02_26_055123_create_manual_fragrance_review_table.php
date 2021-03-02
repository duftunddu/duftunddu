<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualFragranceReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_fragrance_review', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedInteger('fragrance_id')->nullable();
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->float('suitability')->nullable();

            $table->float('temp_avg')->nullable();
            $table->float('hum_avg')->nullable();
            $table->float('dew_point_avg')->nullable();
            $table->float('uv_index_avg')->nullable();
            $table->float('temp_feels_like_avg')->nullable();
            $table->float('atm_pressure_avg')->nullable();
            $table->float('clouds_avg')->nullable();
            $table->float('visibility_avg')->nullable();
            $table->float('wind_speed_avg')->nullable();
            $table->float('rain_avg')->nullable();
            $table->float('snow_avg')->nullable();

            $table->string('weather_main',20)->nullable();
            $table->string('weather_description',30)->nullable();

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
        Schema::dropIfExists('manual_fragrance_review');
    }
}
