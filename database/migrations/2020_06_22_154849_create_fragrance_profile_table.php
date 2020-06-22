<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragrance_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('user_check');
            $table->unsignedTinyInteger('gender');
            $table->date('dob');
            $table->unsignedTinyInteger('profession');
            $table->unsignedTinyInteger('skin_type');
            $table->unsignedTinyInteger('sweat');
            $table->float('height');
            $table->float('weight');
            $table->unsignedTinyInteger('country');
            $table->unsignedTinyInteger('city');
            $table->unsignedTinyInteger('climate');
            $table->unsignedTinyInteger('season');
            $table->string('detail',256)->nullable();
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
        Schema::dropIfExists('fragrance_profile');
    }
}
