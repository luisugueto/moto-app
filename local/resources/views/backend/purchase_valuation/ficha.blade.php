@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div><span class="lang" key="heading">Tasacion Motos</span>
                <div class="page-title-subheading">Ficha de la moto.</div>
            </div>
        </div>
        <div class="page-title-actions">
             
            <div class="d-inline-block dropdown">
                <a href="{{ url('motos-que-nos-ofrecen') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> 
                    <i class="pe-7s-back btn-icon-wrapper"> </i>Regresar
                </a>                     
            </div>         
        </div>
    </div>
</div>
<br>
@if (session('notification'))
    <div class="alert alert-success notification">
        {!! session('notification') !!}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-block notification">
        {{ session('error') }}
    </div>
@endif
<br>
<div class="row" id="ficha">
    <div class="col-md-4">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-c-0" data-toggle="tab" href="#tab-animated-0">
                            <span>Fotos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-1">
                            <span>Documentos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-2">
                            <span>Subir Certificado</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                            <div id="images" class="row"></div>
                        
                        <hr>
                        {!! Form::open(['url'=> 'uploadImage', 'method' => 'POST', 'files'=>'true', 'id' => 'image-dropzone' , 'class' => 'dropzone']) !!}
                            <input type="hidden" id="image_purchase_id" name="id" value="0">
                            <div class="dz-message" style="height:200px;">
                                Arratre sus fotos aquí.
                            </div>
                            <div class="dropzone-previews"></div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                        <div class="row" id="documents">
                            
                        </div>
                        <hr>
                        {!! Form::open(['url'=> 'uploadDocument', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                            <input type="hidden" id="document_purchase_id" name="id" value="0">
                            <div class="dz-message" style="height:200px;">
                                Arratre sus archivos aquí.
                            </div>
                            <div class="dropzone-previews"></div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="tab-animated-2" role="tabpanel">
                        <div class="row" id="certificates">
                            
                        </div>
                        <hr>
                        {!! Form::open(['url'=> 'uploadCertificate', 'method' => 'POST', 'files'=>'true', 'id' => 'certificate-dropzone' , 'class' => 'dropzone']) !!}
                            <input type="hidden" id="certificate_purchase_id" name="id" value="0">
                            <div class="dz-message" style="height:100px;">
                                Arratre su archivo aquí.
                            </div>
                            <div class="dropzone-previews"></div>
                        {!! Form::close() !!}
                    </div>
                </div>                
            </div>
        </div>
   
        <div class="mb-3 card">
            <div class="card-header">
                <div class="card-title">
                    Aplicar Procesos y Subprocesos
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative form-group">
                    <label>Elegir Proceso: </label>
                    <select  class="custom-select custom-control" id="process">
                        <option value="" disabled selected>Seleccione</option>
                        @foreach($processes as $process)
                            <option value="{{ $process->id }}">{{ $process->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="position-relative form-group">
                    <label>Elegir Sub-Proceso para aplicar al vehículo: </label>
                    <select  class="custom-select custom-control custom-control-inline" id="subprocess"  >
                        <option value="" disabled selected>Seleccione</option>
                    </select>
                </div>

                <div class="position-relative form-group" id="incidencia" style="display:none;">
                    <label>Descripción de la incidencia: </label>
                    <input type="text" class="form-control" name="incidencia" id="incidence">
                </div>

                <button type="button" class="btn btn-primary btn-block" id="btn-applySubProcess" value="add">Aplicar</button>
            </div>
        </div>
             
    </div>
    <div class="col-md-8">
        <div class="mb-3 card">
            <div class="card-body">
                <ul class="tabs-animated-shadow tabs-animated nav">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active" id="tab-1" data-toggle="tab" href="#tab-ficha-0">
                            <span>Datos de la moto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-ficha-1">
                            <span>Datos de Contacto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-ficha-2">
                            <span>Estado de la Moto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-3">
                            <span>Datos CATv</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-4">
                            <span>Datos del Propietario</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-5">
                            <span>Datos Bancarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-6">
                            <span>Datos del Representante</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-7">
                            <span>Datos del vehículo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-8">
                            <span>Datos momento de entrega</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-9">
                            <span>Datos del motor (Mécanico)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-ficha-10">
                            <span>Datos Internos</span>
                        </a>
                    </li>
                </ul>
                <form role="form">
                       {{ csrf_field() }}
                    <div class="tab-content" id="formFichaTabs">                    
                        <input type="hidden" id="purchase_id" name="id" value="0">
                        <div class="tab-pane active" id="tab-ficha-0" role="tabpanel">
                            <div class="divider"></div>
                            
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha0" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-3 mostrar">
                                    <div class="position-relative form-group">
                                        <label for="brand" class="">Marca:</label>
                                        <select class="form-control select" name="brand" id="brand" onChange="setModel()" style="width: 100%">
                                            <option value="" disabled selected="">Seleccione</option>
                                            @foreach($marcas as $marca)
                                                <option data-id="{{ $marca->id_category }}" value="{{ $marca->marca }}">{{ $marca->marca }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('brand') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 mostrar">
                                    <div class="position-relative form-group">
                                        <label for="model" class="">Modelo:</label>
                                        <select class="form-control select" name="model" id="model" disabled  style="width: 100%">
                                            <option disabled selected="">Seleccione</option>
                                        </select>
                                        @if ($errors->has('model'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('model') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3 ocultar">
                                    <div class="position-relative form-group">
                                        <label for="brand" class="">Marca:</label>
                                        <input type="text" name="brand" id="brand_text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 ocultar">
                                    <div class="position-relative form-group">
                                        <label for="model" class="">Modelo:</label>
                                        <input type="text" name="model" id="model_text" class="form-control">

                                        @if ($errors->has('model'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('model') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <br>
                                        <button type="button" id="ver" class="btn btn-danger btn-sm mb-3">No encuentro Modelo/marca</button>
                                    </div>
                                </div>

                                <input type="hidden" name="exist_model_brand" id="exist_model_brand" value="0">

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="year" class="">Año:</label>
                                        <select name="year" id="year" class="form-control select" required></select>
                                        @if ($errors->has('year'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="km" class="">KM:</label>
                                        <input name="km" id="km" type="text"
                                            class="form-control" value="{{ old('km') }}" required>
                                        @if ($errors->has('km'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('km') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="created_at" class="">Fecha de Ingreso:</label>
                                        <input name="created_at" id="created_at" type="text" class="form-control" readonly="readonly">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-1" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha1" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="name" class="">Nombre:</label>
                                        <input name="name" id="name" type="text" class="form-control"
                                            value="{{ old('name') }}" required>
                                        @if ($errors->has('name'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="lastname" class="">Apellido:</label>
                                        <input name="lastname" id="lastname" type="text" class="form-control"
                                            value="{{ old('lastname') }}" required>
                                        @if ($errors->has('lastname'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="email" class="">Email:</label>
                                        <input name="email" id="email" type="text" class="form-control"
                                            value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                                   
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="phone" class="">Teléfono:</label>
                                        <input name="phone" id="phone" type="text" class="form-control"
                                            value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="province" class="">Provincia:</label>
                                        <input name="province" id="province" type="province" class="form-control"
                                            value="{{ old('province') }}" required>
                                        @if ($errors->has('province'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-2" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha2" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="status_trafic" class="">Estado en tráfico: </label>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="high" name="status_trafic"
                                                class="custom-control-input" value="Alta">
                                            <label class="custom-control-label" for="high">Alta</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="low" name="status_trafic"
                                                class="custom-control-input" value="Baja definitiva">
                                            <label class="custom-control-label" for="low">Baja</label>
                                        </div>
                                        @if ($errors->has('status_trafic'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('status_trafic') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="position-relative form-group">
                                        <label for="status_vehicle" class="">Estado de la Moto: </label>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="g_del" name="motocycle_state"
                                                class="custom-control-input" value="Golpe Delantero">
                                            <label class="custom-control-label" for="g_del">Golpe Delantero</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="g_tras" name="motocycle_state"
                                                class="custom-control-input" value="Golpe Trasero">
                                            <label class="custom-control-label" for="g_tras">Golpe Trasero</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="av_elec" name="motocycle_state"
                                                class="custom-control-input" value="Avería Eléctrica">
                                            <label class="custom-control-label" for="av_elec">Avería Eléctrica</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="av_mec" name="motocycle_state"
                                                class="custom-control-input" value="Avería Mecánica">
                                            <label class="custom-control-label" for="av_mec">Avería Mecánica</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="old" name="motocycle_state"
                                                class="custom-control-input" value="Vieja o Abandonada">
                                            <label class="custom-control-label" for="old">Vieja o Abandonada</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="status_vehicle" class="">Observaciones: </label>
                                        <textarea class="form-control" id="observations" name="observations"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="status_vehicle" class="">¿Cual es el precio mínimo que aceptas?: </label>
                                        <input type="number" step="any" class="form-control" id="price_min" name="price_min" required>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-3">Datos de Finalización</h5>
                            <div class="card-body" id="form_display_complement">
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-3" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha3" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="file_no" class="">Nº Expediente:</label>
                                        <input name="file_no" id="file_no" type="text" class="form-control"
                                            value="{{ old('file_no') }}">
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
                                            value="{{ old('current_year') }}">
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
                                            class="form-control" value="{{ old('collection_contract_date') }}">
                                        @if ($errors->has('collection_contract_date'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('collection_contract_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row g-1">
                                <div class="col-md-7">
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" name="documents_attached" id="yes_documents_attached"
                                                class="custom-control-input" value="1"  @if(old('documents_attached') == '1') checked @endif>
                                            <label class="custom-control-label" for="yes_documents_attached">Se adjunta
                                                documentos de matriculación</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" name="documents_attached" id="non_existence_document"
                                                class="custom-control-input" value="2" @if(old('documents_attached') == '2') checked @endif>
                                            <label class="custom-control-label" for="non_existence_document">Inexistencia
                                                del documento de matriulación</label>
                                        </div>
                                        @if ($errors->has('documents_attached'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('documents_attached') }}</strong>
                                            </span>
                                        @endif
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
                                            @if ($errors->has('vehicle_delivers'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('vehicle_delivers') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-4" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha4" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="firts_name" class="">Nombre:</label>
                                        <input name="firts_name" id="firts_name" type="text" class="form-control"
                                            value="{{ old('firts_name') }}">
                                        @if ($errors->has('firts_name'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('firts_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="firts_surname" class="">1º Apellido:</label>
                                        <input name="firts_surname" id="firts_surname" type="text" class="form-control"
                                            value="{{ old('firts_surname') }}">
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
                                            value="{{ old('dni') }}">
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
                                        <label for="phone_management" class="">Teléfono:</label>
                                        <input name="phone_management" id="phone_management" type="text" class="form-control"
                                            value="{{ old('phone_management') }}">
                                        @if ($errors->has('phone_management'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('phone_management') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="email_management" class="">Email:</label>
                                        <input name="email_management" id="email_management" type="email" class="form-control"
                                            value="{{ old('email_management') }}">
                                        @if ($errors->has('email_management'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('email_management') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row g-1">
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="street" class="">Calle:</label>
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
                                        <label for="province_management" class="">Provincia:</label>
                                        <input name="province_management" id="province_management" type="text" class="form-control"
                                            value="{{ old('province_management') }}">
                                        @if ($errors->has('province_management'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('province_management') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-5" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha5" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
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
                                            value="{{ old('sale_amount') }}">
                                        @if ($errors->has('sale_amount'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('sale_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-6" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha6" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
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
                                            class="form-control" value="{{ old('phone_representantive') }}">
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
                        </div>
                        <div class="tab-pane" id="tab-ficha-7" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha7" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="kilometres" class="">Kilómetros:</label>
                                        <input name="kilometres" id="kilometres" type="tex" class="form-control"
                                            value="{{ old('kilometres') }}">
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
                                <div class="col-md-4">
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
                                            @if ($errors->has('fuel'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('fuel') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row g-1">                                
                                
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="registration_number" class="">Matricula:</label>
                                        <input name="registration_number" id="registration_number" type="text"
                                            class="form-control" value="{{ old('registration_number') }}">
                                        @if ($errors->has('registration_number'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('registration_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="weight" class="">Peso: </label>
                                        <input name="weight" id="weight" type="number" step="0.1" class="form-control" value="{{ old('weight') }}">
                                        @if ($errors->has('weight'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('weight') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>           
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="registration_date" class="">Fecha de Matriculación:</label>
                                        <input name="registration_date" id="registration_date" type="date" class="form-control"
                                            value="{{ old('registration_date') }}">
                                        @if ($errors->has('registration_date'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('registration_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="registration_country" class="">País de Matriculación:</label>
                                        <input name="registration_country" id="registration_country" type="text"
                                            class="form-control" value="{{ old('registration_country') }}">
                                        @if ($errors->has('registration_country'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('registration_country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="frame_no" class="">Nº Bastidor:</label>
                                        <input name="frame_no" id="frame_no" type="text" class="form-control"
                                            value="{{ old('frame_no') }}">
                                        @if ($errors->has('frame_no'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('frame_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="type_motor" class="">Tipo de Motor:</label>
                                        <input name="type_motor" id="type_motor" type="text" class="form-control"
                                            value="{{ old('type_motor') }}">
                                        @if ($errors->has('type_motor'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('type_motor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="approval_certificate" class="">Certificado de Homologación:</label>
                                        <input name="approval_certificate" id="approval_certificate" type="text" class="form-control"
                                            value="{{ old('approval_certificate') }}">
                                        @if ($errors->has('approval_certificate'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('approval_certificate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-ficha-8" role="tabpanel">
                            <div class="divider"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha8" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <div class="mt-3">
                                            Estado del vehículo en tráfico:
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="high_state" name="vehicle_state_trafic"
                                                    class="custom-control-input" value="Alta">
                                                <label class="custom-control-label" for="high_state">Alta</label>
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
                                                    value="Completo">
                                                <label class="custom-control-label" for="full">Completo</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="partially_disassembled" name="vehicle_state"
                                                    class="custom-control-input" value="Parcialmente desmontado">
                                                <label class="custom-control-label" for="partially_disassembled">Parcialmente
                                                    desmontado</label>
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
                        </div>
                        <div class="tab-pane" id="tab-ficha-9" role="tabpanel">
                            <div class="col-md-12">
                                <button class="btn btn-warning float-right" id="editTabFicha9" type="button"><i class="fa fa-edit"></i> Editar</button>
                            </div>
                            <div class="card-body" id="form_display_datos_mecanico"></div>
                            <div class="form-row row g-1">
                                <div class="col-md-6">
                                    <div class="position-relative form-group" id="checkChasisDiv" style="display: block">
                                        <label for="check_chasis" class="">Check Chasis: </label>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="iron" name="check_chasis"
                                                class="custom-control-input" value="Hierro">
                                            <label class="custom-control-label" for="iron">Hierro</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="aluminium" name="check_chasis"
                                                class="custom-control-input" value="Aluminio">
                                            <label class="custom-control-label" for="aluminium">Aluminio</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="truck" name="check_chasis"
                                                class="custom-control-input" value="Camion">
                                            <label class="custom-control-label" for="truck">Para el camión</label>
                                        </div>
                                        @if ($errors->has('check_chasis'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('check_chasis') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                 </div>
                             </div>
                            
                        </div>
                        <div class="tab-pane" id="tab-ficha-10" role="tabpanel">
                            <div class="col-md-12">
                                <button class="btn btn-warning float-right" id="editTabFicha10" type="button"><i class="fa fa-edit"></i> Editar</button>
                            </div>
                            <div class="card-body" id="form_display_datos_internos"></div>
                        </div>
                    </div>
                    <div class="form-row row g-1">
                        <div class="col-md-3"><button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button></div>
                        <div class="col-md-3" id="buttonLabelss"></div>
                        <div class="col-md-3" id="buttonSendMail"></div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
        
        <div class="card-hover-shadow-2x mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="header-icon lnr-database icon-gradient bg-malibu-beach"> </i>Lista de procesos aplicados
                </div>
            </div>
            <div class="scroll-area-lg" id="divProcesosDesguace" style="display: none">
                <div class="scrollbar-container">
                    <div class="p-2">
                        <ul class="todo-list-wrapper list-group list-group-flush" id="ulProcesses">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">

        <div id="divDocumentsViafirma" style="display: none">
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Documentos Destrucción
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        <a class='mb-2 mr-2 btn btn-primary text-white' id="button_document_destruction" title='Enviar Documentos Viafirma'>Enviar Documentos para Destrucción</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <table width="100%" id="tableDocumentsDestruction" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Documentos Destrucción Fallecido
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        <a class='mb-2 mr-2 btn btn-primary text-white' id="button_destruction_deceased" title='Enviar Documentos Viafirma'>Enviar Documentos para Destrucción Fallecido</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <table width="100%" id="tableDestructionDeceased" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Documentos Posible Venta
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        <a class='mb-2 mr-2 btn btn-primary text-white' id="button_possible_sale" title='Enviar Documentos Viafirma'>Enviar Documentos para Posible Venta</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <table width="100%" id="tablePossibleSale" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div> 
            <div class="mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Documentos Posible Venta Fallecido
                    </div>
                    <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                        <a class='mb-2 mr-2 btn btn-primary text-white' id="button_sale_deceased" title='Enviar Documentos Viafirma'>Enviar Documentos para Posible Venta Fallecido</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-2">
                        <table width="100%" id="tableSaleDeceased" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    </div>


</div>


<input id="url" type="hidden" value="{{ url('/purchase_valuation_interested/update_ficha') }}">
<input id="url_process" type="hidden" value="{{ url('/getSubProcesses') }}">
<input id="url_index" type="hidden" value="{{ url('/') }}">

@section('modals')
 
<div class="modal fade" id="modal" role="dialog" aria-labelledby="titleModalImage"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalImage"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="notification alert alert-danger" hidden>
                    <ul id="errors"></ul>
                </div>

                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div id="lightbox" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="imagesCarrousel">
                            </div>
                            <a class="carousel-control-prev" href="#lightbox"  role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#lightbox"  role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
<script type="text/javascript">
    let startYear = 1800;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--)
    {
        $('#year').append($('<option />').val(i).html(i));
    }
</script>
<script src="{{ asset('assets/scripts/js/purchase_valuation_show_ficha.js') }}"></script>
<script>
    var setModel = () => {
    let id = $("#brand").find(':selected').data('id');

    $.ajax({
        url: '{{ url("getModel") }}',
        headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
        data: {
            id:id
        },
        type: 'POST',
        datatype: 'JSON',
        success: function (resp) {
            let select = $("#model").prop('disabled', 'disabled').empty().append("<option disabled='disabled' selected>Seleccione</option>");
            
            resp.model.forEach(function(model, index){
         
                select.append($('<option>', {
                    value: model.marca,
                    text: model.marca
                }));
            });

            select.prop('disabled', false);

        }
    });
};
</script>

@endsection