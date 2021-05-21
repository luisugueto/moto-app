<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseValuationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_valuation', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('brand');
            $table->string('model');
            $table->datetime('year');
            $table->string('km');
            $table->string('email');
            $table->string('name');
            $table->string('lastname');
            $table->string('phone');
            $table->string('province');
            $table->string('status_trafic');
            $table->integer('g_del')->default(0);
            $table->integer('g_tras')->default(0);
            $table->integer('av_elec')->default(0);
            $table->integer('av_mec')->default(0);
            $table->integer('old')->default(0);
            $table->string('price_min');
            $table->string('observations');
            $table->integer('states_id')->unsigned();
            $table->foreign('states_id')->references('id')->on('states')->onDelete('Cascade');
            $table->text('data_serialize');
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
        Schema::drop('purchase_valuation');
    }
}
