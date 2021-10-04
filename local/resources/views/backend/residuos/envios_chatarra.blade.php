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
                <div class="page-title-subheading">Envios para chatarra.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Aluminio</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Hierro</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                    <span>Para el camión</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
                    <span>Histórico</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Envios para chatarra chasis de aluminio
                            {!! Form::open(['url' => 'applyInfChasisAluminio', 'method' => 'post']) !!} 
                            <div class="row">
                                <input type="hidden" name="send_date_chatarra" id="send_date_chatarra" value="{{ date('d-m-Y')}}">                                
                                <div class="col-md-2 mt-1">
                                    <button id="applyInf1" class="btn btn-primary">Obtener Informe</button>
                                </div>
                                
                            </div>
                            {!! Form::close() !!}
                        </h5>     
        
                            <table style="width: 100%" id="tableEnviosChatarraAluminio" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Bastidor</th>
                                        <th>Modelo</th>
                                        <th class="text-center">Matricula</th>
                                        <th class="text-center">Fecha Matriculación</th>
                                    </tr>
                                </thead>
                            </table>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Envios para chatarra chasis de hierro                
                            {!! Form::open(['url' => 'applyInfChasisHierro', 'method' => 'post']) !!} 
                            <div class="row">
                                <input type="hidden" name="send_date_chatarra" id="send_date_chatarra" value="{{ date('d-m-Y')}}">                                
                                <div class="col-md-2 mt-1">
                                    <button id="applyInf2" class="btn btn-primary">Obtener Informe</button>
                                </div>
                                
                            </div>
                            {!! Form::close() !!}
                        </h5>     
        
                            <table style="width: 100%" id="tableEnviosChatarraHierro" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Bastidor</th>
                                        <th>Modelo</th>
                                        <th class="text-center">Matricula</th>
                                        <th class="text-center">Fecha Matriculación</th>
                                    </tr>
                            </table>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Envios de chatarra para el camión
                            <br><br>                   
                            {!! Form::open(['url' => 'applyInfChasisCamion', 'method' => 'post']) !!} 
                            <div class="row">
                                <input type="hidden" name="send_date_chatarra" id="send_date_chatarra" value="{{ date('d-m-Y')}}">                                
                                <div class="col-md-2 mt-1">
                                    <button id="applyInf3" class="btn btn-primary">Obtener Informe</button>
                                </div>
                                
                            </div>
                            {!! Form::close() !!}
                        </h5>     
        
                            <table style="width: 100%" id="tableEnviosChatarraCamion" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Bastidor</th>
                                        <th>Modelo</th>
                                        <th class="text-center">Matricula</th>
                                        <th class="text-center">Fecha Matriculación</th>
                                    </tr>
                            </table>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Histórico de envios
                            <br><br>   
                        </h5> 
                        <table style="width: 100%" id="tableEnviosChatarraHistorico" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Bastidor</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Matricula</th>
                                    <th class="text-center">Fecha Matriculación</th>
                                    <th class="text-center">Tipo Chasis</th>
                                    <th class="text-center">Fecha Envío</th>
                                </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<input id="url" type="hidden" value="{{ url('/envios-chatarra') }}">
{{ csrf_field() }}
<script src="{{ asset('assets/scripts/js/envios_chatarra.js') }}"></script>

@endsection