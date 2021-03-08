<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_no');
            $table->date('current_year');
            $table->date('collection_contract_date');
            $table->boolean('documents_attached');
            $table->boolean('non_existence_document');
            $table->string('vehicle_delivers');
            $table->string('name');
            $table->string('firts_surname');
            $table->string('second_surtname');
            $table->integer('dni');
            $table->date('birthdate');
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->integer('nro_street');
            $table->integer('stairs');
            $table->integer('floor');
            $table->string('letter');
            $table->string('municipality');
            $table->string('postal_code');
            $table->integer('province');
            $table->string('iban');
            $table->double('sale_amount', 15, 8);
            $table->string('name_representantive');
            $table->string('firts_surname_representative');
            $table->string('second_surtname_representantive');
            $table->integer('dni_representative');
            $table->date('birthdate_representative');
            $table->string('phone_representantive');
            $table->string('email_representative');
            $table->string('representation_concept');
            $table->string('brand');
            $table->string('model');
            $table->string('version');
            $table->string('type');
            $table->string('kilometres');
            $table->string('color');
            $table->integer('fuel');
            $table->integer('registration_number');
            $table->date('registration_date');
            $table->string('registration_country');
            $table->string('frame_no');
            $table->string('motor_no');
            $table->boolean('vehicle_state_trafic');
            $table->boolean('vehicle_state');
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
        Schema::drop('purchase_management');
    }
}
