<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::create('prediction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fragrance_profile_id');
            $table->foreign('fragrance_profile_id')->references('id')->on('fragrance_profile')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
        });
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('prediction');
        // Schema::enableForeignKeyConstraints();
    }
}
