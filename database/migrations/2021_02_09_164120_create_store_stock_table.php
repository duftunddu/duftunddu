<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_stock', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('store')
            ->onUpdate('cascade')->onDelete('cascade');
           
            $table->unsignedMediumInteger('fragrance_brand_id')->nullable();
            $table->foreign('fragrance_brand_id')->references('id')->on('fragrance_brand')
            ->onUpdate('cascade')->onDelete('cascade');
            

            $table->unsignedInteger('fragrance_id')->nullable();
            $table->foreign('fragrance_id')->references('id')->on('fragrance')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->string('fragrance_brand_name',100)->nullable();
            $table->string('fragrance_name',100)->nullable();
            
            $table->boolean('available')->nullable();
            
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
        Schema::dropIfExists('store_stock');
    }
}
