<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMototionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mototions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado');
            $table->date('fecha');
            $table->string('moto');
            $table->integer('anio');
            $table->string('km');
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->string('lugar_retiro');
            $table->string('estado_trafico');
            $table->string('golpe_del');
            $table->string('golpe_tras');
            $table->string('av_elec');
            $table->string('av_mec');
            $table->string('aband_viejo');
            $table->string('minimo');
            $table->string('observaciones');
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
        Schema::drop('mototions');
    }
}
