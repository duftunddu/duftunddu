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
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender',10)->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedSmallInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('profession')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('skin_type_id')->nullable();
            $table->foreign('skin_type_id')->references('id')->on('skin_type')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('sweat')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('climate_id')->nullable();
            $table->foreign('climate_id')->references('id')->on('climate')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('season_id')->nullable();
            $table->foreign('season_id')->references('id')->on('season')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('query',40);
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
