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
   $table->foreign('fragrance_id')->references('id')->on('fragrance');
   $table->unsignedMediumInteger('ingredient_id');
   $table->foreign('ingredient_id')->references('id')->on('ingredient');
   $table->unsignedTinyInteger('note');
   $table->unsignedTinyInteger('strength');
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
