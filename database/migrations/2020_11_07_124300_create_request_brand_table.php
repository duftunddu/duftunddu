<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_brand', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name',100);
            $table->string('website')->nullable();
            $table->string('status')->nullable();
            $table->unsignedSmallInteger('votes');
            $table->softDeletes();
        });

        // Request Status = [queued, informed, processing, processed (added)]

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_brand');
    }
}
