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
            $table->unsignedTinyInteger('gender')->nullable();
            $table->unsignedTinyInteger('profession')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->unsignedTinyInteger('skin_type')->nullable();
            $table->unsignedTinyInteger('sweat')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->unsignedTinyInteger('country')->nullable();
            $table->unsignedTinyInteger('city')->nullable();
            $table->unsignedTinyInteger('climate')->nullable();
            $table->unsignedTinyInteger('season')->nullable();
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
