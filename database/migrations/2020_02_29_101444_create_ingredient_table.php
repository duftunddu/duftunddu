<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamps();
            $table->string('name', 35);
            $table->unsignedBigInteger('created_by')->default('1');
            $table->foreign('created_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->default('1');
            $table->foreign('updated_by')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            // $table->string('created_by',30)->nullable();
            // $table->string('updated_by',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient');
    }
}
