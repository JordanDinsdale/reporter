<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealershipManufacturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealership_manufacturer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dealership_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();
            $table->timestamps();
            $table->foreign('dealership_id')->references('id')->on('dealerships');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealership_manufacturer');
    }
}
