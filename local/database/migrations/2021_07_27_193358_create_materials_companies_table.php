<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materials_id')->unsigned();
            $table->foreign('materials_id')->references('id')->on('materials')->onDelete('Cascade');
            $table->integer('waste_companies_id')->unsigned();
            $table->foreign('waste_companies_id')->references('id')->on('waste_companies')->onDelete('Cascade');
            $table->integer('stock')->default(0);
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
        Schema::drop('materials_companies');
    }
}
