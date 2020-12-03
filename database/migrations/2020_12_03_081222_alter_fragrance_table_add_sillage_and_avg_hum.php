<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFragranceTableAddSillageAndAvgHum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fragrance', function (Blueprint $table) {
            $table->unsignedTinyInteger('sillage')->nullable();
            $table->float('avg_hum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fragrance', function (Blueprint $table) {
            $table->dropColumn('sillage');
            $table->dropColumn('avg_hum');
        });
    }
}
