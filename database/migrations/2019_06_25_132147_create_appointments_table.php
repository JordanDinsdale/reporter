<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('surname');
            $table->string('sale')->nullable();
            $table->bigInteger('sales_executive_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->bigInteger('created_by_id')->unsigned();
            $table->timestamps();
            $table->foreign('sales_executive_id')->references('id')->on('users');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
