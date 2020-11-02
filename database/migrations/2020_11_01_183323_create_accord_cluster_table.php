<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccordClusterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accord_cluster', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->timestamps();
            
            $table->unsignedMediumInteger('accord_id');
            $table->foreign('accord_id')->references('id')->on('accord')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedSmallInteger('ingredient_category_id');
            $table->foreign('ingredient_category_id')->references('id')->on('ingredient_category')
            ->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accord_cluster');
    }
}
