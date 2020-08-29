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
            $table->string('normal_name',100);
            $table->unsignedTinyInteger('tier_id');
            $table->foreign('tier_id')->references('id')->on('brand_tier')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('origin_id');
            $table->foreign('origin_id')->references('id')->on('countries')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('discontinued')->default('0');
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
        Schema::dropIfExists('fragrance_brand');
    }
}
