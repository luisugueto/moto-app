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
            $table->integer('purchase_valuation_id')->unsigned();
            $table->foreign('purchase_valuation_id')->references('id')->on('purchase_valuation')->onDelete('Cascade');
            $table->string('file_no');
            $table->date('current_year');
            $table->date('collection_contract_date');
            $table->boolean('documents_attached');
            $table->boolean('non_existence_document');
            $table->string('vehicle_delivers');
            $table->string('name');
            $table->string('firts_surname');
            $table->string('second_surtname');
            $table->string('dni');
            $table->date('birthdate');
            $table->string('phone');
            $table->string('email');
            $table->string('street');
            $table->string('nro_street');
            $table->string('stairs');
            $table->string('floor');
            $table->string('letter');
            $table->string('municipality');
            $table->string('postal_code');
            $table->string('province');
            $table->string('iban');
            $table->double('sale_amount', 15, 8);
            $table->string('name_representantive');
            $table->string('firts_surname_representative');
            $table->string('second_surtname_representantive');
            $table->string('dni_representative');
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
            $table->string('fuel');
            $table->double('weight', 15, 8);
            $table->string('registration_number');
            $table->date('registration_date');
            $table->string('registration_country');
            $table->string('frame_no');
            $table->string('motor_no');
            $table->string('vehicle_state_trafic');
            $table->string('vehicle_state');
            $table->string('dni_doc');
            $table->string('per_circulacion');
            $table->string('ficha_tecnica');
            $table->string('other_docs');
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
        Schema::drop('purchase_management');
    }
}
