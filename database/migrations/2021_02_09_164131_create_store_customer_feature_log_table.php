<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCustomerFeatureLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_customer_feature_log', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('gender',10);
            $table->date('dob');
            $table->unsignedSmallInteger('profession_id');
            $table->foreign('profession_id')->references('id')->on('profession')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('skin_type_id');
            $table->foreign('skin_type_id')->references('id')->on('skin_type')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedTinyInteger('sweat');
            $table->float('height');
            $table->float('weight');
            
            $table->unsignedTinyInteger('climate_id');
            $table->foreign('climate_id')->references('id')->on('climate')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('season_id');
            $table->foreign('season_id')->references('id')->on('season')
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
        Schema::dropIfExists('store_customer_feature_log');
    }
}
