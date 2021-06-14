@extends('layouts.outside')

@section('content')
    <style>
        .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h4>
                        @if (session('notification'))
                        <div class="alert alert-success notification">
                            {!! session('notification') !!}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger alert-block">
                            {{ session('error') }}
                        </div>
                        @endif
                        <strong>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-left">
                                        Datos a Completar Para la entrega de un vehículo                                       
                                    </div>
                                    <div class="float-right">
                                        {{-- Hoja #00 --}}
                                    </div>
                                </div>
                            </div>
                        </strong>
                    </h4>
                    {!! Form::open(['route' => 'purchase_management.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        {{ csrf_field() }}
                        <div class="divider"></div>

                        <input type="hidden" name="purchase_valuation_id" value="{{ $purchase_valuation_id }}">
                        <input type="hidden" name="token_purchase" value="{{ $token_purchase }}">
                        <input type="hidden" name="purchase_id" value="{{ $gestion->id }}">
                        <?php 
                            $fieldsArray = json_decode($purchase->data_serialize);
                            $precio_final = 0;
                            
                            if(!empty($fieldsArray)){

                                foreach ($fieldsArray as $key => $value) {
                                    if ($value->name == 'dLQrpaV2') {
                                        $precio_final = $value->value;
                                    }
                                }
                            }
                        ?>
                        <h6><strong>Datos a complementar por el centro CATv</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="file_no" class="">Nº Expediente:</label>
                                    <input name="file_no" id="file_no" type="text" class="form-control"
                                        value="{{ $gestion->file_no }}" readonly>
                                    @if ($errors->has('file_no'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('file_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="current_year" class="">Año en curso:</label>
                                    <input name="current_year" id="current_year" type="date" class="form-control"
                                        value="{{$gestion->current_year }}">
                                    @if ($errors->has('current_year'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('current_year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="collection_contract_date" class="">Fecha de contrato de recogida:</label>
                                    <input name="collection_contract_date" id="collection_contract_date" type="date"
                                        class="form-control" value="{{ old('collection_contract_date') }}" readonly>
                                    @if ($errors->has('collection_contract_date'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('collection_contract_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">                            
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <div>
                                        El Vehículo lo entrega:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="incumbent" name="vehicle_delivers"
                                                class="custom-control-input" value="Titular" @if(old('vehicle_delivers') == 'Titular') checked @endif>
                                            <label class="custom-control-label" for="incumbent">Titular</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="owner" name="vehicle_delivers"
                                                class="custom-control-input" value="Propietario" @if(old('vehicle_delivers') == 'Propietario') checked @endif>
                                            <label class="custom-control-label" for="owner">Propietario</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="representative" name="vehicle_delivers"
                                                class="custom-control-input" value="Representante" @if(old('vehicle_delivers') == 'Representante') checked @endif>
                                            <label class="custom-control-label" for="representative">Representante</label>
                                        </div>
                                        @if ($errors->has('vehicle_delivers'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('vehicle_delivers') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del Propietario del Vehículo</strong> </h6><br>
                        
                        <div class="form-row row g-1">
                            <div class="col-md-12">
                                <a class="btn-icon btn-icon-only btn-pill btn btn-outline-light float-right" data-toggle="modal" data-target=".modalAyuda3" data-backdrop="static" data-keyboard="false"><i class="pe-7s-help1"></i> Ayuda General</a> 
                            </div>

                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="name" class="">Nombre: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda1" data-backdrop="static" data-keyboard="false" style="margin-top: -11px;"><i class="pe-7s-help1"></i></a>
                                    </label>
                                    <input name="name" id="name" type="text" class="form-control"
                                        value="{{ $gestion->name }}">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firts_surname" class="">1º Apellido:</label>
                                    <input name="firts_surname" id="firts_surname" type="text" class="form-control"
                                        value="{{ $gestion->firts_surname }}">
                                    @if ($errors->has('firts_surname'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('firts_surname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="second_surtname" class="">2º Apellido:</label>
                                    <input name="second_surtname" id="second_surtname" type="text" class="form-control"
                                        value="{{ old('second_surtname') }}">
                                    @if ($errors->has('second_surtname'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('second_surtname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="dni" class="">Dni/nif:</label>
                                    <input name="dni" id="dni" type="text" class="form-control"
                                        value="{{ old('dni') }}" onblur="ValidateSpanishID(this.value)">
                                    @if ($errors->has('dni'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('dni') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="birthdate" class="">Fecha de Nacimiento:</label>
                                    <input name="birthdate" id="birthdate" type="date" class="form-control"
                                        value="{{ old('birthdate') }}">
                                    @if ($errors->has('birthdate'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="phone" class="">Teléfono:</label>
                                    <input name="phone" id="phone" type="text" class="form-control input-phone"
                                        value="{{ $gestion->phone }}">
                                    @if ($errors->has('phone'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="email" class="">Email:</label>
                                    <input name="email" id="email" type="email" class="form-control"
                                        value="{{ $gestion->email }}">
                                    @if ($errors->has('email'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="street" class="">Calle: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda1" data-backdrop="static" data-keyboard="false" style="margin-top: -11px;"><i class="pe-7s-help1"></i></a></label>
                                    <input name="street" id="street" type="text" class="form-control"
                                        value="{{ old('street') }}">
                                    @if ($errors->has('street'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="nro_street" class="">Nº: </label>
                                    <input name="nro_street" id="nro_street" type="number" class="form-control"
                                        value="{{ old('nro_street') }}">
                                    @if ($errors->has('nro_street'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('nro_street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="stairs" class="">Escalera:</label>
                                    <input name="stairs" id="stairs" type="number" class="form-control"
                                        value="{{ old('stairs') }}">
                                    @if ($errors->has('stairs'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('stairs') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="floor" class="">Piso:</label>
                                    <input name="floor" id="floor" type="number" class="form-control"
                                        value="{{ old('floor') }}">
                                    @if ($errors->has('floor'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('floor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative form-group">
                                    <label for="letter" class="">Letra:</label>
                                    <input name="letter" id="letter" type="text" class="form-control"
                                        value="{{ old('letter') }}">
                                    @if ($errors->has('letter'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('letter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="municipality" class="">Municipio:</label>
                                    <input name="municipality" id="municipality" type="text" class="form-control"
                                        value="{{ old('municipality') }}">
                                    @if ($errors->has('municipality'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('municipality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="postal_code" class="">CP:</label>
                                    <input name="postal_code" id="postal_code" type="text" class="form-control"
                                        value="{{ old('postal_code') }}">
                                    @if ($errors->has('postal_code'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="province" class="">Provincia:</label>
                                    <input name="province" id="province" type="text" class="form-control"
                                        value="{{ old('province') }}">
                                    @if ($errors->has('province'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('province') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos Bancarios para realizar el pago</strong> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="iban" class="">IBAN: ES</label>
                                    <input name="iban" id="iban" type="text" class="form-control input-iban"
                                        value="{{ old('iban') }}" max="28">
                                    @if ($errors->has('iban'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('iban') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="sale_amount" class="">Importe de Venta( Iva Incl):</label>
                                    <input name="sale_amount" id="sale_amount" type='number' step="0.1" class="form-control"
                                        value="{{  $precio_final }}" readonly>
                                    @if ($errors->has('sale_amount'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('sale_amount') }}</strong>
                                        </span>
                                    @endif
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
                                        class="form-control" value="{{ old('name_representantive') }}">
                                    @if ($errors->has('name_representantive'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('name_representantive') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="firts_surname_representative" class="">1º Apellido:</label>
                                    <input name="firts_surname_representative" id="firts_surname_representative" type="text"
                                        class="form-control" value="{{ old('firts_surname_representative') }}">
                                    @if ($errors->has('firts_surname_representative'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('firts_surname_representative') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="second_surtname_representantive" class="">2º Apellido:</label>
                                    <input name="second_surtname_representantive" id="second_surtname_representantive"
                                        type="text" class="form-control"
                                        value="{{ old('second_surtname_representantive') }}">
                                    @if ($errors->has('second_surtname_representantive'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('second_surtname_representantive') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="dni_representative" class="">Dni/nif:</label>
                                    <input name="dni_representative" id="dni_representative" type="text"
                                        class="form-control" value="{{ old('dni_representative') }}">
                                    @if ($errors->has('dni_representative'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('dni_representative') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="birthdate_representative" class="">Fecha de Nacimiento:</label>
                                    <input name="birthdate_representative" id="birthdate_representative" type="date"
                                        class="form-control" value="{{ old('birthdate_representative') }}">
                                    @if ($errors->has('birthdate_representative'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('birthdate_representative') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="phone_representantive" class="">Teléfono:</label>
                                    <input name="phone_representantive" id="phone_representantive" type="text"
                                        class="form-control input-phone" value="{{ old('phone_representantive') }}">
                                    @if ($errors->has('phone_representantive'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('phone_representantive') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="email_representative" class="">Email:</label>
                                    <input name="email_representative" id="email_representative" type="email"
                                        class="form-control" value="{{ old('email_representative') }}">
                                    @if ($errors->has('email_representative'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('email_representative') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <label for="representation_concept" class="">Concepto de representación:</label>
                                    <input name="representation_concept" id="representation_concept" type="text"
                                        class="form-control" value="{{ old('representation_concept') }}">
                                    @if ($errors->has('representation_concept'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('representation_concept') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h6><strong>Datos del vehículo</strong> </label> </h6>
                        <div class="form-row row g-1">
                            <div class="col-md-12">
                                <a class="btn-icon btn-icon-only btn-pill btn btn-outline-light float-right" data-toggle="modal" data-target=".modalAyuda3" data-backdrop="static" data-keyboard="false"><i class="pe-7s-help1"></i> Ayuda General</a> 
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="brand" class="">Marca: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda1" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="brand" id="brand" type="text" class="form-control"
                                        value="{{ $gestion->brand }}">
                                    @if ($errors->has('brand'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="model" class="">Modelo:</label>
                                    <input name="model" id="model" type="text" class="form-control"
                                        value="{{ $gestion->model }}">
                                    @if ($errors->has('model'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="version" class="">Versión:</label>
                                    <input name="version" id="version" type="text" class="form-control"
                                        value="{{ old('version') }}">
                                    @if ($errors->has('version'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('version') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="type" class="">Tipo:</label>
                                    <input name="type" id="type" type="text" class="form-control"
                                        value="{{ old('type') }}">
                                    @if ($errors->has('type'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="kilometres" class="">Kilómetros:</label>
                                    <input name="kilometres" id="kilometres" type="tex" class="form-control"
                                        value="{{ $gestion->kilometres }}">
                                    @if ($errors->has('kilometres'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('kilometres') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="color" class="">Color:</label>
                                    <input name="color" id="color" type="text" class="form-control"
                                        value="{{ old('color') }}">
                                    @if ($errors->has('color'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('color') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <div class="mt-3">
                                        Combustible:
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="gasoline" name="fuel" class="custom-control-input"
                                                value="Gasolina" checked @if(old('fuel') == 'Gasolina') checked @endif>
                                            <label class="custom-control-label" for="gasoline">Gasolina</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="diesel_oil" name="fuel" class="custom-control-input"
                                                value="Gasóleo" @if(old('fuel') == 'Gasóleo') checked @endif>
                                            <label class="custom-control-label" for="diesel_oil">Gasóleo</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="others" name="fuel" class="custom-control-input"
                                                value="Otros" @if(old('fuel') == 'Otros') checked @endif>
                                            <label class="custom-control-label" for="others">Otros</label>
                                        </div>
                                        @if ($errors->has('fuel'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('fuel') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="weight" class="">Peso: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda4" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="weight" id="weight" type="number" step="0.1" class="form-control" value="{{ old('weight') }}">
                                    @if ($errors->has('weight'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="registration_number" class="">Matricula:   <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda2" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="registration_number" id="registration_number" type="text"
                                        class="form-control" value="{{ old('registration_number') }}">
                                    @if ($errors->has('registration_number'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('registration_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="registration_date" class="">Fecha de Matriculación: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda1" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="registration_date" id="registration_date" type="date" class="form-control"
                                        value="{{ old('registration_date') }}">
                                    @if ($errors->has('registration_date'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('registration_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="registration_country" class="">País de Matriculación:</label>
                                    <input name="registration_country" id="registration_country" type="text"
                                        class="form-control" value="España">
                                    @if ($errors->has('registration_country'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('registration_country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="frame_no" class="">Nº Bastidor:  <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda2" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="frame_no" id="frame_no" type="text" maxlength="17" class="form-control" value="{{ old('frame_no') }}">
                                    <input name="frame_no" id="frame_no_7" type="text" maxlength="7" class="form-control" style="display:none;" disabled>
                                    <label for="frame_no" class="">Si tú Nº Bastidor es 7 dígitos (click aquí): <input type="checkbox" id="vin7Digitos" name="vin7Digitos" value="{{ old('vin7Digitos') }}"></label>
                                    <!-- <span id="result"></span> -->
                                    @if ($errors->has('frame_no'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('frame_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="motor_no" class="">Nº Motor: <a class="mr-2 btn-icon btn-icon-only btn-pill btn btn-outline-light" data-toggle="modal" data-target=".modalAyuda2" data-backdrop="static" data-keyboard="false" style="margin-top:-11px"><i class="pe-7s-help1"></i></a></label>
                                    <input name="motor_no" id="motor_no" type="text" class="form-control"
                                        value="{{ old('motor_no') }}">
                                    @if ($errors->has('motor_no'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('motor_no') }}</strong>
                                        </span>
                                    @endif
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
                                                class="custom-control-input" value="Alta" @if( $gestion->vehicle_state_trafic == 'Alta') checked @endif>
                                            <label class="custom-control-label" for="high">Alta</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="final_discharge" name="vehicle_state_trafic"
                                                class="custom-control-input" value="Baja definitiva" @if( $gestion->vehicle_state_trafic == 'Baja definitiva') checked @endif>
                                            <label class="custom-control-label" for="final_discharge">Baja
                                                definitiva</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="temporary_leave" name="vehicle_state_trafic"
                                                class="custom-control-input" value="Baja temporal" @if( $gestion->vehicle_state_trafic == 'Baja temporal') checked @endif>
                                            <label class="custom-control-label" for="temporary_leave">Baja temporal</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('vehicle_state_trafic'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('vehicle_state_trafic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <div class="mt-3">
                                        Estado del vehículo:
                                        <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="g_del" name="vehicle_state"
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('vehicle_state') == 'Golpe Delantero' || $purchase->motocycle_state == 'Golpe Delantero') checked @endif>
                                                <label class="custom-control-label" for="g_del">Golpe Delantero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="g_tras" name="vehicle_state"
                                                    class="custom-control-input" value="Golpe Trasero" @if(old('vehicle_state') == 'Golpe Trasero' || $purchase->motocycle_state == 'Golpe Trasero') checked @endif>
                                                <label class="custom-control-label" for="g_tras">Golpe Trasero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_elec" name="vehicle_state"
                                                    class="custom-control-input" value="Avería Eléctrica" @if(old('vehicle_state') == 'Avería Eléctrica' || $purchase->motocycle_state == 'Avería Eléctrica') checked @endif>
                                                <label class="custom-control-label" for="av_elec">Avería Eléctrica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_mec" name="vehicle_state"
                                                    class="custom-control-input" value="Avería Mecánica" @if(old('vehicle_state') == 'Avería Mecánica' || $purchase->motocycle_state == 'Avería Mecánica') checked @endif>
                                                <label class="custom-control-label" for="av_mec">Avería Mecánica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="old" name="vehicle_state"
                                                    class="custom-control-input" value="Vieja o Abandonada" @if(old('vehicle_state') == 'Vieja o Abandonada' || $purchase->motocycle_state == 'Vieja o Abandonada') checked @endif>
                                                <label class="custom-control-label" for="old">Vieja o Abandonada</label>
                                            </div>
                                    </div>
                                    @if ($errors->has('vehicle_state'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('vehicle_state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" name="documents_attached" id="yes_documents_attached"
                                                class="custom-control-input" value="1"  @if(old('documents_attached') == '1') checked @endif>
                                            <label class="custom-control-label" for="yes_documents_attached">Se adjunta
                                                documentos de matriculación:</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" name="documents_attached" id="non_existence_document"
                                                class="custom-control-input" value="2" @if(old('documents_attached') == '2') checked @endif>
                                            <label class="custom-control-label" for="non_existence_document">Inexistencia
                                                del documento de matriulación:</label>
                                        </div>
                                        @if ($errors->has('documents_attached'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('documents_attached') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar&hellip;</span></label>
                                <small id="file-1Help" class="form-text text-muted text-center">DNI obligatorio * <br>(Dos archivos, cara A del DNI y Cara B del DNI)</small>
                                @if ($errors->has('file-1'))
                                    <span class="error text-danger">
                                        <strong>{{ $errors->first('file-1') }}</strong>
                                    </span>
                                @endif
                                @if (\Session::has('error_file-1'))
                                    <span class="error text-danger">
                                        <strong>{{ \Session::get('error_file-1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-3 text-center">
                                <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar&hellip;</span></label>
                                <small id="file-2Help" class="form-text text-muted text-center">Permiso de Circulación <br>(Dos archivos, cara A del Permiso Circulación y Cara B del Permiso Circulación)</small>
                            </div>
                            <div class="col-3 text-center">
                                <input type="file" name="file-3[]" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar&hellip;</span></label>
                                <small id="file-3Help" class="form-text text-muted text-center">Ficha Técnica <br>(Dos archivos, cara A de la Ficha Técnica y Cara B de la Ficha Técnica)</small>
                            </div>
                            <div class="col-3 text-center">
                                <input type="file" name="file-4[]" id="file-4" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple />
                                <label for="file-4"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar&hellip;</span></label>
                                <small id="file-4Help" class="form-text text-muted text-center">Otros documentos</small>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type='submit' class="mt-2 btn btn-primary btn-lg ">Enviar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <div class="modal fade modalAyuda1" id="" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">                 
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="{{ asset('assets/images/ayuda1.jpeg')}}" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalAyuda2" id="" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">                 
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="{{ asset('assets/images/ayuda2.jpeg')}}" alt="" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalAyuda3" id="" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">                 
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('assets/images/ayuda1.jpeg')}}" alt="" class="img-fluid w-100">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/images/ayuda2.jpeg')}}" alt="" class="img-fluid w-100">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/images/ayuda3.jpeg')}}" alt="" class="img-fluid w-100">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Siguiente</span>
                        </a>
                      </div>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalAyuda4" id="" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">                 
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('assets/images/ayuda_peso.jpeg')}}" alt="" class="img-fluid w-100">
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/images/ayuda_peso2.jpeg')}}" alt="" class="img-fluid w-100">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Siguiente</span>
                        </a>
                      </div>
                   
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".input-iban").keyup(function () { //Keylistener HTML: <input type="text" class="input-iban">
            val = jQuery(this).val()
                .replace(new RegExp(" ", 'g'), ''); //remove spaces
                
            val_chars = val.split(""); //split chars 
            val = ""; //new value
            
            count = 1;
            for(index in val_chars) {
                if(count <= 2) { //first 2 alphabetical chars
                    val_chars[index] = val_chars[index].toUpperCase(); //uppercase, example: dE => DE
                    if (val_chars[index].search(/^[A-Z]+$/) == -1) { //search für A-Z
                        break; //if not found (error)
                    }
                }else {
                    if (val_chars[index].search(/^[0-9]+$/) == -1) { //search for 0-9
                        continue; //if not found (error)
                    }
                }
                if(val.length < 24){
                    val += val_chars[index]; // add char to return Value
                }
                if(count%4 == 0 && val.length < 24) { //Avery 4 chars an space
                    val += " "; 
                }
                
                count++;
            }
            jQuery(this).val(val); //set to Textfield value
        });    

        $(function() {
          $("#frame_no").on("keyup blur", function() {
            let vin = $("#frame_no").val().toUpperCase();
            $("#frame_no").val(vin);

            if (validateVin(vin)){
                console.log('VIN válido')
                // $("#result").html("VIN válido");
            }
            else{
                console.log('VIN no válido');
                // $("#result").html("VIN no válido");
            }
          }).trigger("blur");
        });

        $(function() {
          $("#vin7Digitos").on("click", function() {

           vin7Digitos();
          }).trigger("blur");
        });
          
        function validateVin(vin) {
          var re = new RegExp("^[A-HJ-NPR-Z\\d]{8}[\\dX][A-HJ-NPR-Z\\d]{2}\\d{6}$");
          return vin.match(re);
        }

        function vin7Digitos(){
            if($('#vin7Digitos').is(':checked')){
                $("#frame_no").css('display', 'none'); 
                $("#frame_no").attr('disabled', 'disabled'); 

                $("#frame_no_7").removeAttr('disabled');  
                $("#frame_no_7").show();  

            }else{
                $("#frame_no_7").css('display', 'none'); 
                $("#frame_no_7").attr('disabled', 'disabled'); 

                $("#frame_no").removeAttr('disabled'); 
                $("#frame_no").show();    
            }

        }

        $(".input-phone").keyup(function () { //Keylistener HTML: <input type="text" class="input-iban">
            val = jQuery(this).val()
                .replace(new RegExp(" ", 'g'), ''); //remove spaces
                
            val_chars = val.split(""); //split chars 
            val = ""; //new value
            
            count = 1;
            for(index in val_chars) {                
                if (val_chars[index].search(/^[0-9]+$/) == -1) { //search for 0-9
                    continue; //if not found (error)
                }
               
                if(val.length < 9){
                    val += val_chars[index]; // add char to return Value
                }
                // if(count%4 == 0 && val.length < 24) { //Avery 4 chars an space
                //     val += " "; 
                // }
                
                count++;
            }
            jQuery(this).val(val); //set to Textfield value
        }); 
 
 
    </script>
@endsection
