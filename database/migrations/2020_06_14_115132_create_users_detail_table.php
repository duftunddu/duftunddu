<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
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
            $table->string('details',256);
            $table->unsignedTinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_detail');
    }
}
