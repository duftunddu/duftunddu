<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('fragrance', function (Blueprint $table) {
   $table->increments('id');
   $table->timestamps();
   $table->unsignedMediumInteger('brand_id');
   $table->foreign('brand_id')->references('id')->on('fragrance_brand');
   $table->string('name', 100);
   $table->unsignedTinyInteger('type');
   $table->unsignedTinyInteger('gender_appropriation');
   $table->unsignedInteger('cost');
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('fragrance');
 }
}
