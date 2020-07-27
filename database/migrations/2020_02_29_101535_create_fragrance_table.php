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
        $table->foreign('brand_id')->references('id')->on('fragrance_brand')
        ->onUpdate('cascade')->onDelete('cascade');
        $table->string('name',100);
        $table->string('normal_name',100);
        $table->unsignedTinyInteger('type_id');
        $table->foreign('type_id')->references('id')->on('fragrance_type')
        ->onUpdate('cascade')->onDelete('cascade');
        $table->string('gender',10);
        $table->unsignedInteger('cost');
        $table->string('currency',4);
        $table->string('created_by',30)->nullable();
        $table->string('updated_by',30)->nullable();
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
