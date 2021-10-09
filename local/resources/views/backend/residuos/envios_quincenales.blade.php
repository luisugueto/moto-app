@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Residuos
                <div class="page-title-subheading">Envios Quincenales.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="input-group col-md-3">
                <select name="applySubProcesses" class="custom-select" id="applySubProcesses">
                    <option value="" disabled selected>Elegir Destino de la Moto</option>
                    @foreach($subprocesses as $subprocesse)
                        <option value="{{ $subprocesse->id }}">{{ $subprocesse->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="btnApplySubProcesses">Aplicar</button>
                </div>
            </div>
        </div>

        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Pendientes de descargas</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Informes ya descargados</span>
                </a>
            </li>
        </ul>
        @if (session('notification'))
            <div class="alert alert-success notification">
                {!! session('notification') !!}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-block error">
                {{ session('error') }}
            </div>
        @endif
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Envios Quincenales
                            <br><br>
                            {!! Form::open(['url' => 'applyInfQuincenalSinDescargar', 'method' => 'post', 'id' => 'formApply']) !!} 
                                <input type="hidden" name="apply" id="applyForm">
                                <div class="row">
                                    <label class="col-sm-1 col-form-label"><b>Desde:</b> </label>
                                    <div class="col-sm-2">
                                        <input type="date" id="start_at" name="start_at" title="Desde" value="{{ old('start_at') }}" class="form-control custom-control-inline" required>
                                    </div>
                                    <label class="col-sm-1 col-form-label"><b>Hasta:</b> </label>
                                    <div class="col-md-2">
                                        <input type="date" id="end_at" name="end_at" title="Hasta" value="{{ old('end_at') }}" class="form-control custom-control-inline" required>
                                    </div>
                                    <div class="col-md-2 mt-1">
                                        <button class="btn btn-primary" id="clearFields">Limpiar campos</button>
                                    </div>
                                    <div class="col-md-2 mt-1">
                                        <button id="applyInf" class="btn btn-primary">Obtener Informe</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}

                            {!! Form::open(['url' => 'downloadCertificados', 'method' => 'post', 'id' => 'formDownload']) !!} 
                                <input type="hidden" name="apply" id="applyFormDownload">
                                <input type="hidden" name="start_at" id="start_at_download">
                                <input type="hidden" name="end_at" id="end_at_download">

                                <div class="col-md-2 mt-2">
                                    <button id="applyDownload" class="btn btn-primary">Descargar Certificados</button>
                                </div>
                            {!! Form::close() !!}

                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_1" type="checkbox" data-column="1" checked><label class="inline-label tr" key="Modelo" for="column_1">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Matricula" for="column_2">Matricula</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_3" type="checkbox" data-column="3"><label class="inline-label tr" key="Fecha Matriculación" for="column_3">Fecha Matriculación</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_4" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Bastidor" for="column_4">Bastidor</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_5" type="checkbox" data-column="5"><label class="inline-label tr" key="Estado en tráf." for="column_5">Estado en tráf.</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_6" type="checkbox" data-column="6"><label class="inline-label tr" key="Peso" for="column_6">Peso</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_8" type="checkbox" data-column="7" checked><label class="inline-label tr" key="Titular" for="column_8">Titular</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_9" type="checkbox" data-column="8" checked><label class="inline-label tr" key="Dni" for="column_9">Dni</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_10" type="checkbox" data-column="9"><label class="inline-label tr" key="Fecha de Nacimiento" for="column_10">Fecha de Nacimiento</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_11" type="checkbox" data-column="10"><label class="inline-label tr" key="Direccion" for="column_11">Direccion</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_12" type="checkbox" data-column="11"><label class="inline-label tr" key="Codigo Postal" for="column_12">Codigo Postal</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_13" type="checkbox" data-column="12"><label class="inline-label tr" key="Poblacion" for="column_13">Poblacion</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_14" type="checkbox" data-column="13" checked><label class="inline-label tr" key="Provincia" for="column_14">Provincia</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_15" type="checkbox" data-column="14" checked><label class="inline-label tr" key="Estado Moto" for="column_15">Estado Moto</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_16" type="checkbox" data-column="15" checked><label class="inline-label tr" key="Fecha de Baja" for="column_16">Fecha de Baja</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_17" type="checkbox" data-column="16" checked>
                                        <label class="inline-label tr" key="N° Certificado de Destrucción" for="column_17">N° Certificado de Destrucción</label>
                                    </button>
                                    
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="444" type="checkbox" data-column="17" checked>
                                        <label class="inline-label tr" key="Fecha Certificado de Destrucción" for="444">Fecha Certificado de Destrucción</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_19" type="checkbox" data-column="18"><label class="inline-label tr" key="Fecha de Descontaminacion" for="column_19">Fecha de Descontaminacion</label>
                                    </button>
                                </div>
                            </div>
                        </h5>     
        
                            <table style="width: 100%" id="tableEnviosQuincenalesSinDescargar" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Modelo</th>
                                        <th class="text-center">Matricula</th>
                                        <th class="text-center">Fecha Matriculación</th>
                                        <th class="text-center">Bastidor</th>
                                        <th class="text-center">Estado en tráf.</th>
                                        <th class="text-center">Peso (kg)</th>
                                        <th class="text-center">Titular</th>
                                        <th class="text-center">Dni</th>
                                        <th class="text-center">Fecha de Nacimiento</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Codigo Postal</th>
                                        <th class="text-center">Poblacion</th>
                                        <th class="text-center">Provincia</th>
                                        <th class="text-center">Estado Moto</th>
                                        <th class="text-center">Fecha de Baja</th>
                                        <th class="text-center">N° Certificado de Destrucción</th>
                                        <th class="text-center">Fecha Certificado de Destrucción</th>
                                        <th class="text-center">Fecha de Descontaminacion</th>
                                    </tr>
                                </thead>
                            </table>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Envios Quincenales
                            <br><br>
                            {!! Form::open(['url' => 'applyInfQuincenalDescargados', 'method' => 'post', 'id' => 'formApply1']) !!} 
                                <div class="row">
                                    <input type="hidden" name="apply" id="applyForm1">
                                    <label class="col-sm-1 col-form-label"><b>Desde:</b> </label>
                                    <div class="col-sm-2">
                                        <input type="date" name="start_at" title="Desde" value="{{ old('start_at') }}" class="form-control custom-control-inline" required>
                                    </div>
                                    <label class="col-sm-1 col-form-label"><b>Hasta:</b> </label>
                                    <div class="col-md-2">
                                        <input type="date" name="end_at" title="Hasta" value="{{ old('end_at') }}" class="form-control custom-control-inline" required>
                                    </div>
                                    <div class="col-md-2 mt-1">
                                        <button id="applyInf1" class="btn btn-primary">Obtener Informe</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}

                             <!-- {!! Form::open(['url' => 'downloadCertificados', 'method' => 'post', 'id' => 'formDownload1']) !!} 
                                <input type="hidden" name="apply" id="applyFormDownload1">
                                <div class="col-md-2 mt-1">
                                    <button type="button" id="applyDownload1" class="btn btn-primary">Descargar Certificados</button>
                                </div>
                            {!! Form::close() !!} -->

                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_1-1" type="checkbox" data-column="1" checked><label class="inline-label tr" key="Modelo" for="column_1-1">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_2-1" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Matricula" for="column_2-1">Matricula</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_3-1" type="checkbox" data-column="3"><label class="inline-label tr" key="Fecha Matriculación" for="column_3-1">Fecha Matriculación</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_4-1" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Bastidor" for="column_4-1">Bastidor</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_5-1" type="checkbox" data-column="5"><label class="inline-label tr" key="Estado en tráf." for="column_5-1">Estado en tráf.</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_6-1" type="checkbox" data-column="6"><label class="inline-label tr" key="Peso" for="column_6-1">Peso</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_8-1" type="checkbox" data-column="7" checked><label class="inline-label tr" key="Titular" for="column_8-1">Titular</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_9-1" type="checkbox" data-column="8" checked><label class="inline-label tr" key="Dni" for="column_9-1">Dni</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_10-1" type="checkbox" data-column="9"><label class="inline-label tr" key="Fecha de Nacimiento" for="column_10-1">Fecha de Nacimiento</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_11-1" type="checkbox" data-column="10"><label class="inline-label tr" key="Direccion" for="column_11-1">Direccion</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_12-1" type="checkbox" data-column="11"><label class="inline-label tr" key="Codigo Postal" for="column_12-1">Codigo Postal</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_13-1" type="checkbox" data-column="12"><label class="inline-label tr" key="Poblacion" for="column_13-1">Poblacion</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_14-1" type="checkbox" data-column="13" checked><label class="inline-label tr" key="Provincia" for="column_14-1">Provincia</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_15-1" type="checkbox" data-column="14" checked><label class="inline-label tr" key="Estado Moto" for="column_15-1">Estado Moto</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_16-1" type="checkbox" data-column="15" checked><label class="inline-label tr" key="Fecha de Baja" for="column_16-1">Fecha de Baja</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_17-1" type="checkbox" data-column="16" checked><label class="inline-label tr" key="N° Certificado de Destrucción" for="column_17-1">N° Certificado de Destrucción</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_18-1" type="checkbox" data-column="17" checked><label class="inline-label tr" key="Fecha Certificado de Destrucción" for="column_18-1">Fecha Certificado de Destrucción</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_19-1" type="checkbox" data-column="18"><label class="inline-label tr" key="Fecha de Descontaminacion" for="column_19-1">Fecha de Descontaminacion</label>
                                    </button>
                                </div>
                            </div>
                        </h5>     
        
                            <table style="width: 100%" id="tableEnviosQuincenalesDescargados" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Modelo</th>
                                        <th class="text-center">Matricula</th>
                                        <th class="text-center">Fecha Matriculación</th>
                                        <th class="text-center">Bastidor</th>
                                        <th class="text-center">Estado en tráf.</th>
                                        <th class="text-center">Peso (kg)</th>
                                        <th class="text-center">Titular</th>
                                        <th class="text-center">Dni</th>
                                        <th class="text-center">Fecha de Nacimiento</th>
                                        <th class="text-center">Direccion</th>
                                        <th class="text-center">Codigo Postal</th>
                                        <th class="text-center">Poblacion</th>
                                        <th class="text-center">Provincia</th>
                                        <th class="text-center">Estado Moto</th>
                                        <th class="text-center">Fecha de Baja</th>
                                        <th class="text-center">N° Certificado de Destrucción</th>
                                        <th class="text-center">Fecha Certificado de Destrucción</th>
                                        <th class="text-center">Fecha de Descontaminacion</th>
                                    </tr>
                                </thead>
                            </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<input id="url" type="hidden" value="{{ url('/envios-quincenales') }}">
{{ csrf_field() }}
<script src="{{ asset('assets/scripts/js/envios_quincenales.js') }}"></script>

@endsection