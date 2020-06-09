<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerceiverTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('perceiver', function (Blueprint $table) {
   $table->bigIncrements('id');
   $table->timestamps();
   $table->unsignedInteger('fragrance_id');
   $table->foreign('fragrance_id')->references('id')->on('fragrance');
   $table->unsignedTinyInteger('gender');
   $table->unsignedTinyInteger('profession');
   $table->unsignedTinyInteger('age');
   $table->unsignedTinyInteger('skin_type');
   $table->unsignedTinyInteger('sweat');
   $table->float('height');
   $table->unsignedTinyInteger('bodyshape');
   $table->float('weight');
   $table->unsignedTinyInteger('country');
   $table->unsignedTinyInteger('city');
   $table->unsignedTinyInteger('climate');
   $table->unsignedTinyInteger('season');
   $table->string('comment', 256);
   $table->unsignedTinyInteger('like');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('perceiver');
 }
}
