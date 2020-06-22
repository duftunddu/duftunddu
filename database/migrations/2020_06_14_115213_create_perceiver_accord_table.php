<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerceiverAccordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perceiver_accord', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at');
            $table->unsignedBigInteger('perceiver_id');
            $table->foreign('perceiver_id')->references('id')->on('perceiver')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedMediumInteger('accord_id');
            $table->foreign('accord_id')->references('id')->on('accord')
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
        Schema::dropIfExists('perceiver_accord');
    }
}
