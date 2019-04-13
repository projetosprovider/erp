<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_schedule_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('fleet_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fleet_car_id')->unsigned();
            $table->foreign('fleet_car_id')->references('id')->on('fleet_cars');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('fleet_schedule_statuses');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('route')->nullable();
            $table->string('reason');
            $table->string('ride_to')->nullable();
            $table->integer('request_by')->unsigned();
            $table->foreign('request_by')->references('id')->on('users');
            $table->integer('approved')->default(false);
            $table->integer('approved_by')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
