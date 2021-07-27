<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residuos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materials_id')->unsigned();
            $table->foreign('materials_id')->references('id')->on('materials')->onDelete('Cascade');
            $table->string("delivery");
            $table->string("in_installation");
            $table->string("dcs");
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
        Schema::drop('residuos');
    }
}
