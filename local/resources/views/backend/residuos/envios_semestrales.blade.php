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
                <div class="page-title-subheading">Envios Semestrales.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Envios Semestrales     
                    <br><br>                   
                    {!! Form::open(['url' => 'applyInf', 'method' => 'post']) !!} 
                        <div class="row">
                            
                            <label class="col-sm-1 col-form-label"><b>Desde:</b> </label>
                            <div class="col-sm-2">
                                <input type="date" name="start_at" title="Desde" value="{{ old('start_at') }}" class="form-control custom-control-inline" required>
                            </div>
                            <label class="col-sm-1 col-form-label"><b>Hasta:</b> </label>
                            <div class="col-md-2">
                                 <input type="date" name="end_at" title="Hasta" value="{{ old('end_at') }}" class="form-control custom-control-inline" required>
                            </div>
                            <div class="col-md-2 mt-1">
                                <button type="submit" class="btn btn-primary">Obtener Informe</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </h5>     
  
                <table style="width: 100%" id="tableEnviosSemestrales" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Numero de Proceso</th>
                            <th>Codigo LER</th>
                            <th>Residuo</th>
                            <th>Entrega (Kg)</th>
                            <th>En Instalaciones (Kg)</th>
                            <th>DCS (Cuando lo entregan)</th>
                            <th>Fecha Retirada</th>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>

    </div>
</div>
<input id="url" type="hidden" value="{{ url('/envios-semestrales') }}">
{{ csrf_field() }}
<script src="{{ asset('assets/scripts/js/envios_semestrales.js') }}"></script>

@endsection