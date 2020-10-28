<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ip_from');
            $table->unsignedInteger('ip_to');
            $table->char('country_code', 2);
            $table->string('country_name',64);
            $table->string('region_name',128);
            $table->string('city_name',128);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('zip_code',30);
            $table->string('time_zone',8);
        });

        DB::update("ALTER TABLE location AUTO_INCREMENT = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
}
