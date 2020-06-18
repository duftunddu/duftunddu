<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerceivedCompositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perceived_composition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('perceiver_id');
            $table->foreign('perceiver_id')->references('id')->on('perceiver');
            $table->unsignedMediumInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredient');
            $table->unsignedTinyInteger('note');
            $table->unsignedTinyInteger('strength');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perceived_composition');
    }
}
