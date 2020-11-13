<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_form', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->unsignedBigInteger('feedback_id');
            $table->foreign('feedback_id')->references('id')->on('feedback')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedTinyInteger('user_interface')->nullable();           
            $table->unsignedTinyInteger('functionality')->nullable();           
            $table->unsignedTinyInteger('recommend')->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_form');
    }
}
