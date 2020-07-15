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
            $table->timestamp('created_at');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender',10)->nullable();
            $table->unsignedTinyInteger('profession')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedTinyInteger('skin_type_id')->nullable();
            $table->unsignedTinyInteger('sweat')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->unsignedTinyInteger('country_id')->nullable();
            $table->unsignedTinyInteger('city_id')->nullable();
            $table->unsignedTinyInteger('climate_id')->nullable();
            $table->unsignedTinyInteger('season_id')->nullable();
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
