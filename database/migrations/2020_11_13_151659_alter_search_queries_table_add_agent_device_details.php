<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSearchQueriesTableAddAgentDeviceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('search_queries', function (Blueprint $table) {
            $table->string('device', 20)->nullable();
            $table->string('platform', 20)->nullable();
            $table->string('browser', 20)->nullable();
            $table->string('version', 20)->nullable();
            $table->boolean('desktop')->nullable();
            $table->boolean('phone')->nullable();
            $table->boolean('tablet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_queries', function (Blueprint $table) {
            $table->dropColumn('device');
            $table->dropColumn('platform');
            $table->dropColumn('browser');
            $table->dropColumn('version');
            $table->dropColumn('desktop');
            $table->dropColumn('phone');
            $table->dropColumn('tablet');
        });
    }
}
