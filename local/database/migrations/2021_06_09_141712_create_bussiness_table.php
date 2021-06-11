<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBussinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('Cascade');
            $table->string('name', 200)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code', 200)->nullable();
            $table->string('city', 200)->nullable();
            $table->string('province', 200)->nullable();
            $table->string('cif', 200)->nullable();
            $table->string('email', 200)->nullable();
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
        Schema::drop('business');
    }
}
