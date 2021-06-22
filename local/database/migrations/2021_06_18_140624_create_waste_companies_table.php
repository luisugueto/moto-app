<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWasteCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waste_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('email_id')->unsigned()->nullable();
            $table->string('name', 200)->nullable();
            $table->string('nif_inst_destination', 30)->nullable();
            $table->string('reason_social_inst_destination', 200)->nullable();
            $table->string('nima_inst_destination', 200)->nullable();
            $table->string('type_via', 50)->nullable();
            $table->string('name_via', 50)->nullable();
            $table->string('number', 50)->nullable();
            $table->string('flat', 50)->nullable();
            $table->string('door', 50)->nullable();
            $table->string('postal_code', 50)->nullable();
            $table->string('location', 200)->nullable();
            $table->string('province', 200)->nullable();
            $table->string('country', 200)->nullable();
            $table->string('authorization_no', 200)->nullable();
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
        Schema::drop('waste_companies');
    }
}
