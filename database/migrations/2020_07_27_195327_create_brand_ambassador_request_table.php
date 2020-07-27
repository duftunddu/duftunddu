<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandAmbassadorRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_ambassador_request', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedMediumInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('fragrance_brand')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->string('brand_name')->nullable();
            $table->string('linkedin')->unique()->nullable();
            $table->string('email_work')->unique()->nullable();
            $table->string('website')->nullable();
            $table->unsignedTinyInteger('status');
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
        Schema::dropIfExists('brand_ambassador_request');
    }
}
