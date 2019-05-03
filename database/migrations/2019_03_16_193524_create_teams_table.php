<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->enum('status', ['RESERVADO', 'EM ANDAMENTO', 'FINALIZADA', 'CANCELADA'])->default('RESERVADO');
            $table->integer('vacancies')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('team_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->datetime('start');
            $table->datetime('end');
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
        Schema::dropIfExists('team_schedule');
        Schema::dropIfExists('teams');
    }
}
