<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('request_status', 10)->nullable();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
           
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->boolean('store')->nullable();
            $table->boolean('webstore')->nullable();
            
            $table->string('name', 50);
            $table->string('address')->unique()->nullable();
            $table->string('website', 64)->unique()->nullable();

            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->string('contact_number', 40)->nullable();
            $table->string('social_link', 64)->nullable();
            $table->string('status', 10)->nullable();

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
        Schema::dropIfExists('store');
    }
}
