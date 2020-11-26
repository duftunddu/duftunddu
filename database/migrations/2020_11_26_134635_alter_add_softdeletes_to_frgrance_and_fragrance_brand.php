<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddSoftdeletesToFrgranceAndFragranceBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fragrance_brand', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('fragrance', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('fragrance_brand_availability', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('fragrance_ingredient', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('fragrance_accord', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('perceived_composition', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        Schema::table('perceiver_accord', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('search_queries', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fragrance_brand', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('fragrance', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('fragrance_brand_availability', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('fragrance_ingredient', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('fragrance_accord', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('perceived_composition', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        
        Schema::table('perceiver_accord', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('search_queries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

    }
}
