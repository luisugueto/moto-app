@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div>Mototion
                    <div class="page-title-subheading">Ingrese los detalles del formulario para registrar la información
                        solicitada.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ url('mototion') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> <i
                            class="pe-7s-back-2 btn-icon-wrapper"> </i>Volver</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h4>
                        <strong>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-left">
                                        Datos a Cumplimentar Para la entrega de un vehículo
                                    </div>
                                    <div class="float-right">
                                        Hoja #00
                                    </div>
                                </div>
                            </div>
                        </strong>
                    </h4>
                    <form class="">
                        <div class="divider"></div>
                        <h6><strong>Datos a cumplimentar por el centro CATv</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="file_no" class="">Nº Expediente:</label>
                                    <input name="file_no" id="file_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="current_year" class="">Año en curso:</label>
                                    <input name="current_year" id="current_year" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="collection_contract_date" class="">Fecha de contrato de recogida:</label>
                                    <input name="collection_contract_date" id="collection_contract_date" type="date"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                            <input type="checkbox" name="documents_attached" id="documents_attached"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="documents_attached">Se adjunta
                                                documentos de matriculación:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-checkbox custom-control custom-control-inline">
                                            <input type="checkbox" name="non_existence_document" id="non_existence_document"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="non_existence_document">Inexistencia
                                                del documento de matriulación:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <div>
                                        El Vehículo lo entrega:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="incumbent" name="vehicle_delivers"
                                                class="custom-control-input" value="Titular">
                                            <label class="custom-control-label" for="incumbent">Titular</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="owner" name="vehicle_delivers"
                                                class="custom-control-input" value="Propietario">
                                            <label class="custom-control-label" for="owner">Propietario</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="representative" name="vehicle_delivers"
                                                class="custom-control-input" value="Representante">
                                            <label class="custom-control-label" for="representative">Representante</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del Propietario del Vehículo</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="name" class="">Nombre:</label>
                                    <input name="name" id="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firts_surname" class="">1º Apellido:</label>
                                    <input name="firts_surname" id="firts_surname" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="second_surtname" class="">2º Apellido:</label>
                                    <input name="second_surtname" id="second_surtname" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="dni" class="">Dni/nif:</label>
                                    <input name="dni" id="dni" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="birthdate" class="">Fecha de Nacimiento:</label>
                                    <input name="birthdate" id="birthdate" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="phone" class="">Teléfono:</label>
                                    <input name="phone" id="phone" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="email" class="">Email:</label>
                                    <input name="email" id="email" type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="street" class="">Calle:</label>
                                    <input name="street" id="street" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="nro_street" class="">Nº: </label>
                                    <input name="nro_street" id="nro_street" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="stairs" class="">Escalera:</label>
                                    <input name="stairs" id="stairs" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="floor" class="">Piso:</label>
                                    <input name="floor" id="floor" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="letter" class="">Letra:</label>
                                    <input name="letter" id="letter" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="municipality" class="">Municipio:</label>
                                    <input name="municipality" id="municipality" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="postal_code" class="">CP:</label>
                                    <input name="postal_code" id="postal_code" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="province" class="">Provincia:</label>
                                    <input name="province" id="province" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos Bancarios para realizar el pagoulo</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="iban" class="">IBAN: ES</label>
                                    <input name="iban" id="iban" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="sale_amount" class="">Importe de Venta( Iva Incl):</label>
                                    <input name="sale_amount" id="sale_amount" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del Representante del propietario del vehículo</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="name_representantive" class="">Nombre:</label>
                                    <input name="name_representantive" id="name_representantive" type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firts_surname_representative" class="">1º Apellido:</label>
                                    <input name="firts_surname_representative" id="firts_surname_representative" type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="second_surtname_representantive" class="">2º Apellido:</label>
                                    <input name="second_surtname_representantive" id="second_surtname_representantive"
                                        type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="dni_representative" class="">Dni/nif:</label>
                                    <input name="dni_representative" id="dni_representative" type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="birthdate_representative" class="">Fecha de Nacimiento:</label>
                                    <input name="birthdate_representative" id="birthdate_representative" type="date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="phone_representantive" class="">Teléfono:</label>
                                    <input name="phone_representantive" id="phone_representantive" type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="email_representative" class="">Email:</label>
                                    <input name="email_representative" id="email_representative" type="email"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="representation_concept" class="">Concepto de representación:</label>
                                    <input name="representation_concept" id="representation_concept" type="text"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del vehículo</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="brand" class="">Marca:</label>
                                    <input name="brand" id="brand" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="model" class="">Modelo:</label>
                                    <input name="model" id="model" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="version" class="">Versión:</label>
                                    <input name="version" id="version" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="type" class="">Tipo:</label>
                                    <input name="type" id="type" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="Kilometres" class="">Kilómetros:</label>
                                    <input name="Kilometres" id="Kilometres" type="tex" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="color" class="">Color:</label>
                                    <input name="color" id="color" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <div class="mt-3">
                                        Combustible:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="gasoline" name="fuel" class="custom-control-input"
                                                value="Gasolina">
                                            <label class="custom-control-label" for="gasoline">Gasolina</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="diesel_oil" name="fuel" class="custom-control-input"
                                                value="Gasóleo">
                                            <label class="custom-control-label" for="diesel_oil">Gasóleo</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="others" name="fuel" class="custom-control-input"
                                                value="Otros">
                                            <label class="custom-control-label" for="others">Otros</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="registration_number" class="">Matricula:</label>
                                    <input name="registration_number" id="registration_number" type="text"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="registration_date" class="">Fecha de Matriculación:</label>
                                    <input name="registration_date" id="registration_date" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="registration_country" class="">País de Matriculación:</label>
                                    <input name="registration_country" id="registration_country" type="text"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="frame_no" class="">Nº Bastidor:</label>
                                    <input name="frame_no" id="frame_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="motor_no" class="">Nº Motor:</label>
                                    <input name="motor_no" id="motor_no" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del vehículo en el momento de entrega</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <div class="mt-3">
                                        Estado del vehículo en tráfico:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="high" name="vehicle_state_trafic"
                                                class="custom-control-input" value="Alta">
                                            <label class="custom-control-label" for="high">Alta</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="final_discharge" name="vehicle_state_trafic"
                                                class="custom-control-input" value="Baja definitiva">
                                            <label class="custom-control-label" for="final_discharge">Baja
                                                definitiva</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="temporary_leave" name="vehicle_state_trafic"
                                                class="custom-control-input" value="Baja temporal">
                                            <label class="custom-control-label" for="temporary_leave">Baja temporal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <div class="mt-3">
                                        Estado del vehículo:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="sinister" name="vehicle_state"
                                                class="custom-control-input" value="Siniestrado">
                                            <label class="custom-control-label" for="sinister">Siniestrado</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="damaged" name="vehicle_state"
                                                class="custom-control-input" value="Averiado">
                                            <label class="custom-control-label" for="damaged">Averiado</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="abandoned" name="vehicle_state"
                                                class="custom-control-input" value="Abandonado">
                                            <label class="custom-control-label" for="abandoned">Abandonado</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="full" name="vehicle_state" class="custom-control-input"
                                                value="Completo ">
                                            <label class="custom-control-label" for="full">Completo</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="partially_disassembled" name="vehicle_state"
                                                class="custom-control-input" value="Parcialmente desmontado">
                                            <label class="custom-control-label" for="partially_disassembled">Parcialmente
                                                desmontado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="mt-2 btn btn-primary btn-lg">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
