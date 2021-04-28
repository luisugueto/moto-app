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
                <a href="{{ url('purchase_valuation_interested') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> 
                    <i class="pe-7s-back btn-icon-wrapper"> </i>Regresar
                </a>                     
            </div>         
        </div>
    </div>
</div>
<div class="row">
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
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                        <p class="mb-0">Aqui veran las fotos y agregaran mas</p>
                    </div>
                    <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                        <p class="mb-0">Aqui veran los y agregaran mas</p>
                    </div>
                </div>
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
                </ul>
                <form role="form" method="POST" action="{{ route('updateFicha') }}" enctype='multipart/form-data'>
                       {{ csrf_field() }}
                    <div class="tab-content" id="formFichaTabs">                    
                        <input type="hidden" id="purchase_id" name="id" value="0">
                        <div class="tab-pane active" id="tab-ficha-0" role="tabpanel">
                            <div class="divider"></div>
                            
                            <div class="form-row row g-1">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" id="editTabFicha0" type="button"><i class="fa fa-edit"></i> Editar</button>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="model" class="">Modelo:</label>
                                        <select class="form-control select" name="model" id="model" disabled  style="width: 100%">
                                            <option value="" disabled selected="">Seleccione</option>
                                        </select>
                                        @if ($errors->has('model'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('model') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="year" class="">Año:</label>
                                        <input name="year" id="year" type="date"
                                            class="form-control" value="{{ old('year') }}" required>
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
                                            <input type="radio" id="g_del" name="g_del"
                                                class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="g_del">Golpe Delantero</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="g_tras" name="g_tras"
                                                class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="g_tras">Golpe Trasero</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="av_elec" name="av_elec"
                                                class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="av_elec">Avería Eléctrica</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="av_mec" name="av_mec"
                                                class="custom-control-input" value="1">
                                            <label class="custom-control-label" for="av_mec">Avería Mecánica</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="old" name="old"
                                                class="custom-control-input" value="1">
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
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <div>
                                            <div class="custom-checkbox custom-control custom-control-inline">
                                                <input type="checkbox" name="documents_attached" id="documents_attached"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="documents_attached">Se adjunta
                                                    documentos de matriculación:</label>
                                            </div>
                                            @if ($errors->has('documents_attached'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('documents_attached') }}</strong>
                                                </span>
                                            @endif
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
                                            @if ($errors->has('non_existence_document'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('non_existence_document') }}</strong>
                                                </span>
                                            @endif
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
                                        <input firts_name="firts_name" id="firts_name" type="text" class="form-control"
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
                                        <label for="phone" class="">Teléfono:</label>
                                        <input name="phone" id="phone" type="text" class="form-control"
                                            value="{{ old('phone') }}">
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
                                            value="{{ old('email') }}">
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
                                        <input name="iban" id="iban" type="text" class="form-control"
                                            value="{{ old('iban') }}">
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
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="brand_management" class="">Marca:</label>
                                        <input name="brand_management" id="brand_management" type="text" class="form-control"
                                            value="{{ old('brand_management') }}">
                                        @if ($errors->has('brand_management'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('brand_management') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="model_management" class="">Modelo:</label>
                                        <input name="model_management" id="model_management" type="text" class="form-control"
                                            value="{{ old('model_management') }}">
                                        @if ($errors->has('model_management'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('model_management') }}</strong>
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
                                            value="{{ old('kilometres') }}">
                                        @if ($errors->has('kilometres'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('kilometres') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                            </div>
                            <div class="form-row row g-1">
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="motor_no" class="">Nº Motor:</label>
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
                                        @if ($errors->has('vehicle_state'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('vehicle_state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    
                </form>
            </div>
        </div>

    </div>
</div>

@section('modals')
<script src="{{ asset('assets/scripts/js/purchase_valuation_show_ficha.js') }}"></script>
@endsection
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
            let select = $("#model").empty().append("<option disabled='disabled' selected>Seleccione</option>");

            select.prop('disabled', 'disabled');
            $("#model").empty();
            
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