<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryAndCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE country_and_city
        AS
        SELECT DISTINCT country_name, city_name
        FROM location
        WHERE (country_name != "-" AND city_name != "-")
        ORDER BY country_name, city_name');

        DB::statement('ALTER TABLE `country_and_city` ADD COLUMN `id` INT AUTO_INCREMENT UNIQUE FIRST;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_and_city');
    }
}
