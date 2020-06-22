<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragranceBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fragrance_brand', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->timestamps();
            $table->string('name',100);
            $table->unsignedTinyInteger('tier');
            $table->string('origin', 45);
            $table->unsignedTinyInteger('discontinued')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fragrance_brand');
    }
}
