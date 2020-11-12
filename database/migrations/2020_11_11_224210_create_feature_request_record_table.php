<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureRequestRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_request_record', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamps();

            $table->unsignedSmallInteger('feature_request_id');
            $table->foreign('feature_request_id')->references('id')->on('feature_request')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->boolean('vote_status');
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feature_request_record');
    }
}
