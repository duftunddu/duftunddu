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
            $table->timestamp('created_at');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('fragrance_id');
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
			$table->unsignedTinyInteger('gender');
            $table->date('dob');
            $table->unsignedTinyInteger('age');
			$table->unsignedTinyInteger('profession');
            $table->unsignedTinyInteger('skin_type');
            $table->unsignedTinyInteger('sweat');
			$table->float('height');
			$table->float('weight');
            $table->unsignedTinyInteger('country');
			$table->unsignedTinyInteger('city');
			$table->unsignedTinyInteger('climate');
			$table->unsignedTinyInteger('season');
			$table->string('comment',256);
            $table->unsignedTinyInteger('like');
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
        Schema::dropIfExists('perceiver');
    }
}
