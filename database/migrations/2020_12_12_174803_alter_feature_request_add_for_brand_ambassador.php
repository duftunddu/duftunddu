<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFeatureRequestAddForBrandAmbassador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feature_request', function (Blueprint $table) {
            $table->boolean('for_brand_ambassador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feature_request', function (Blueprint $table) {
            $table->dropColumn('for_brand_ambassador');
        });
    }
}
