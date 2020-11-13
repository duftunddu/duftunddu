<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->unsignedBigInteger('feedback_id');
            $table->foreign('feedback_id')->references('id')->on('feedback')
            ->onUpdate('cascade')->onDelete('cascade');
           
            $table->unsignedTinyInteger('feedback_type_id');
            $table->foreign('feedback_type_id')->references('id')->on('feedback_type')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->string('comment', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_comment');
    }
}
