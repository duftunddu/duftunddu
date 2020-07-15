<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perceiver', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('fragrance_profile')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('fragrance_id');
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender',10);
            $table->date('dob');
            $table->unsignedTinyInteger('age');
            $table->unsignedTinyInteger('profession_id');
            $table->unsignedTinyInteger('skin_type_id');
            $table->unsignedTinyInteger('sweat');
            $table->float('height');
            $table->float('weight');
            $table->unsignedTinyInteger('country_id');
            $table->unsignedTinyInteger('city_id');
            $table->unsignedTinyInteger('climate_id');
            $table->unsignedTinyInteger('season_id');
            $table->string('comment',256);
            $table->unsignedTinyInteger('like');
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
        Schema::dropIfExists('perceiver');
    }
}
