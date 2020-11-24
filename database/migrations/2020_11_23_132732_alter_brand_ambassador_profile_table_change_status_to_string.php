<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBrandAmbassadorProfileTableChangeStatusToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_ambassador_profile', function (Blueprint $table) {
            $table->string('status', 30)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brand_ambassador_profile', function (Blueprint $table) {
            // $table->unsignedTinyInteger('status')->change();
        });
    }
}