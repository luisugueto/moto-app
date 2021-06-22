<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyCompaniesAndWasteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_companies_and_waste', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('waste_company_id')->unsigned();
            $table->foreign('waste_company_id')->references('id')->on('waste_companies')->onDelete('Cascade');
            $table->integer('waste_id')->unsigned();
            $table->foreign('waste_id')->references('id')->on('waste')->onDelete('Cascade');
            $table->string('delivery', 200)->nullable();
            $table->string('in_facilities', 200)->nullable();
            $table->string('dcs_when_delivered', 200)->nullable();
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
        Schema::drop('apply_companies_and_waste');
    }
}
