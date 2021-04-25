<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->integer('purchase_valuation_id')->unsigned();
            $table->foreign('purchase_valuation_id')->references('id')->on('states')->onDelete('Cascade');
            $table->integer('status')->default(0);
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
        Schema::drop('links_registers');
    }
}
