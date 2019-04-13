<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_car_statues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('fleet_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('description');
            $table->string('model');
            $table->string('brand');
            $table->string('year');
            $table->date('bought_at')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('fleet_car_statues');
            $table->boolean('active')->default(true);
            $table->date('inactivated_at')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('fleet_car_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('fleet_car_id')->unsigned();
            $table->foreign('fleet_car_id')->references('id')->on('fleet_cars');
            $table->integer('last_status_id')->nullable();
            $table->integer('actual_status_id')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet_car_log');
        Schema::dropIfExists('fleet_cars');
        Schema::dropIfExists('fleet_car_statues');
    }
}
