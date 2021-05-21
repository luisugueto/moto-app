<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplySubProcessAndProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_sub_process_and_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('processes_id')->unsigned();
            $table->foreign('processes_id')->references('id')->on('processes')->onDelete('Cascade');
            $table->integer('subprocesses_id')->unsigned();
            $table->foreign('subprocesses_id')->references('id')->on('subprocesses')->onDelete('Cascade');
            $table->integer('purchase_valuation_id')->unsigned();
            $table->foreign('purchase_valuation_id')->references('id')->on('purchase_valuation')->onDelete('Cascade');
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
        Schema::drop('apply_sub_process_and_processes');
    }
}
