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
            $table->unsignedTinyInteger('age');
            $table->unsignedSmallInteger('profession_id');
            $table->foreign('profession_id')->references('id')->on('profession')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('skin_type_id');
            $table->foreign('skin_type_id')->references('id')->on('skin_type')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('sweat');
            $table->float('height');
            $table->float('weight');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('climate_id');
            $table->foreign('climate_id')->references('id')->on('climate')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('season_id');
            $table->foreign('season_id')->references('id')->on('season')
            ->onUpdate('cascade')->onDelete('cascade');
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
