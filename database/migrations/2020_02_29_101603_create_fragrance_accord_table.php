<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceAccordTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('fragrance_accord', function (Blueprint $table) {
   $table->bigIncrements('id');
   $table->timestamps();
   $table->unsignedInteger('fragrance_id');
   $table->foreign('fragrance_id')->references('id')->on('fragrance');
   $table->unsignedMediumInteger('accord_id');
   $table->foreign('accord_id')->references('id')->on('accord');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('fragrance_accord');
 }
}
