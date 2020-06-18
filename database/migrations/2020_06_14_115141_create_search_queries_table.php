<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_queries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('users_detail_id');
            $table->foreign('users_detail_id')->references('id')->on('users_detail');
            $table->unsignedTinyInteger('gender');
            $table->unsignedTinyInteger('profession');
            $table->date('dob');
            $table->unsignedTinyInteger('age');
            $table->unsignedTinyInteger('skin_type');
            $table->unsignedTinyInteger('sweat');
            $table->float('height');
            $table->float('weight');
            $table->unsignedTinyInteger('country');
            $table->unsignedTinyInteger('city');
            $table->unsignedTinyInteger('climate');
            $table->unsignedTinyInteger('season');
            $table->string('query',256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_queries');
    }
}
