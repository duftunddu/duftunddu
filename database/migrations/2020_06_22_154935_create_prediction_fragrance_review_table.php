<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionFragranceReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediction_fragrance_review', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('prediction_fragrance_id');
            $table->foreign('prediction_fragrance_id')->references('id')->on('prediction_fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedinteger('fragrance_id');
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
            $table->unsignedTinyInteger('review');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prediction_fragrance_review');
    }
}
