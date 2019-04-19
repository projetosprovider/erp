<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->integer('user_id')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('occupation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->boolean('active')->default(true);
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone', 15)->nullable();
            $table->string('cpf', 15);
            $table->date('birthday')->nullable();
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->integer('occupation_id')->unsigned();
            $table->foreign('occupation_id')->references('id')->on('occupation');
            $table->time('start_day')->nullable();
            $table->time('lunch')->nullable();
            $table->time('lunch_return')->nullable();
            $table->time('end_day')->nullable();
            $table->integer('weekly_workload')->nullable();

            $table->boolean('active')->default(true);
            $table->uuid('uuid')->unique();

            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {

          $table->increments('id');

          $table->integer('person_id')->unsigned();
          $table->foreign('person_id')->references('id')->on('people');

          $table->string('nick');
          $table->string('email')->unique();
          $table->string('password');
          $table->enum('avatar_type', ['words', 'upload'])->default('words');
          $table->text('avatar')->nullable();

          $table->boolean('do_task')->default(true);

          $table->string('login_soc')->nullable();
          $table->string('password_soc')->nullable();
          $table->string('id_soc')->nullable();

          $table->boolean('change_password')->default(false);
          $table->timestamp('email_verified_at')->nullable();

          $table->string('api_token')->nullable();
          $table->string('status')->default('offline');

          $table->boolean('active')->default(true);

          $table->uuid('uuid')->unique();

          $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('people');
        Schema::dropIfExists('occupation');
        Schema::dropIfExists('departments');
    }
}
