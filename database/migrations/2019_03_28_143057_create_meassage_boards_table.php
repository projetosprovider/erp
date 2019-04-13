<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeassageBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meassage_board_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('meassage_boards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('type_id')->unsigned()->index();
            $table->foreign('type_id')->references('id')->on('meassage_board_types');
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->integer('like')->default(0);
            $table->boolean('important')->default(false);
            $table->uuid('uuid')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('meassage_board_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->foreign('board_id')->references('id')->on('meassage_boards');
            $table->integer('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users');
            $table->text('content')->nullable();
            $table->integer('like')->default(0);
            $table->uuid('uuid')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('meassage_board_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->nullable();
            $table->string('extension')->nullable();
            $table->integer('board_id')->unsigned();
            $table->foreign('board_id')->references('id')->on('meassage_boards');
            $table->string('link');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('meassage_board_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->foreign('board_id')->references('id')->on('meassage_boards');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });

        Schema::create('meassage_board_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('board_id')->unsigned();
            $table->foreign('board_id')->references('id')->on('meassage_boards');
            $table->enum('status', ['PENDENTE', 'ENVIADO', 'VISUALIZADO', 'REMOVIDO'])->default('PENDENTE');
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
        Schema::dropIfExists('meassage_board_users');
        Schema::dropIfExists('meassage_board_attachments');
        Schema::dropIfExists('meassage_board_comments');
        Schema::dropIfExists('meassage_boards');
        Schema::dropIfExists('meassage_board_types');
    }
}
