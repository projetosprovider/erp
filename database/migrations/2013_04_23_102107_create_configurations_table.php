<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('description')->nullable();
            $table->longText('value')->nullable();
            $table->string('table')->nullable();
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('configurations_types');
            $table->boolean('active')->default(true);
            $table->boolean('can_drop')->default(true);
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
        Schema::dropIfExists('configurations');
    }
}
