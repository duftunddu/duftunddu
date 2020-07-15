<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceBrandAvailabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragrance_brand_availability', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedMediumInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('fragrance_brand')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')
            ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fragrance_brand_availability');
    }
}
