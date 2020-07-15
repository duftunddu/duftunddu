<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceIngredientTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
    Schema::create('fragrance_ingredient', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->timestamps();
        $table->unsignedInteger('fragrance_id');
        $table->foreign('fragrance_id')->references('id')->on('fragrance')
        ->onUpdate('cascade')->onDelete('cascade');
        $table->unsignedMediumInteger('ingredient_id');
        $table->foreign('ingredient_id')->references('id')->on('ingredient')
        ->onUpdate('cascade')->onDelete('cascade');
        $table->string('note',10);
        $table->unsignedTinyInteger('intensity');
    });

 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('fragrance_ingredient');
 }
}
