<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('feedback_event_id');
            $table->foreign('feedback_event_id')->references('id')->on('feedback_event')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at');
            $table->unsignedTinyInteger('input');
            $table->string('device',10);
            $table->unsignedTinyInteger('type');
            $table->string('feedback', 256);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
