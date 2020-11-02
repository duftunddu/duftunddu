<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientCategoryClusterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_category_cluster', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->timestamps();
            
            $table->unsignedMediumInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredient')
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
        Schema::dropIfExists('ingredient_category_cluster');
    }
}
