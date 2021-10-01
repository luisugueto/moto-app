<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesPurchaseValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates_purchase_valuations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_valuation_id')->unsigned();
            $table->foreign('purchase_valuation_id')->references('id')->on('purchase_valuation')->onDelete('Cascade');
            $table->string('name');
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
        Schema::drop('certificates_purchase_valuations');
    }
}
