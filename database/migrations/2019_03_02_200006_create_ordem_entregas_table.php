<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('delivery_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('delivery_order_statuses');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('delivered_by')->unsigned();
            $table->foreign('delivered_by')->references('id')->on('users');
            $table->integer('delivered_at')->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('annotations')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('receipt')->nullable();
            $table->timestamps();
        });

        Schema::create('delivery_order_documents', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('delivery_order_id')->unsigned();
            $table->foreign('delivery_order_id')->references('id')->on('delivery_order');
            $table->integer('document_id')->unsigned();
            $table->foreign('document_id')->references('id')->on('documents');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('ordens_entrega');
    }
}
