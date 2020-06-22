<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionFragranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediction_fragrance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prediction_id');
            $table->foreign('prediction_id')->references('id')->on('prediction')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('fragrance_id');
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('prediction_fragrance');
        // Schema::enableForeignKeyConstraints();
    }
}
