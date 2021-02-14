<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_log', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('store')
            ->onUpdate('cascade')->onDelete('cascade');
           
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
 
            $table->string('store_type',10)->nullable();
           
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('location')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('store_customer_feature_log_id')->nullable();
            $table->foreign('store_customer_feature_log_id')->references('id')->on('store_customer_feature_log')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('store_stock_id')->nullable();
            $table->foreign('store_stock_id')->references('id')->on('store_stock')
            ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('store_log');
    }
}
