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
                    <div class="mb-2 mr-2 btn-group float-right">
                        <button type="button" aria-haspopup="true" aria-expanded="false"
                            data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_1" type="checkbox" data-column="0"><label class="inline-label tr" key="Modelo" for="column_1">Modelo</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_2" type="checkbox" data-column="1" checked><label class="inline-label tr" key="Matricula" for="column_2">Matricula</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_3" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha Matriculación" for="column_3">Fecha Matriculación</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_4" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Bastidor" for="column_4">Bastidor</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_5" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Estado en tráf." for="column_5">Estado en tráf.</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_6" type="checkbox" data-column="5" checked><label class="inline-label tr" key="Peso" for="column_6">Peso</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_8" type="checkbox" data-column="6" checked><label class="inline-label tr" key="Titular" for="column_8">Titular</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_9" type="checkbox" data-column="7" checked><label class="inline-label tr" key="Dni" for="column_9">Dni</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_10" type="checkbox" data-column="8" checked><label class="inline-label tr" key="Fecha de Nacimiento" for="column_10">Fecha de Nacimiento</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_11" type="checkbox" data-column="9" checked><label class="inline-label tr" key="Direccion" for="column_11">Direccion</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_12" type="checkbox" data-column="10" checked><label class="inline-label tr" key="Codigo Postal" for="column_12">Codigo Postal</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_13" type="checkbox" data-column="11" checked><label class="inline-label tr" key="Poblacion" for="column_13">Poblacion</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_14" type="checkbox" data-column="12" checked><label class="inline-label tr" key="Provincia" for="column_14">Provincia</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_15" type="checkbox" data-column="13" checked><label class="inline-label tr" key="Estado Moto" for="column_15">Estado Moto</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_16" type="checkbox" data-column="14" checked><label class="inline-label tr" key="Fecha de Baja" for="column_16">Fecha de Baja</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_17" type="checkbox" data-column="15"><label class="inline-label tr" key="N° Certificado de Destrucción" for="column_17">N° Certificado de Destrucción</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_18" type="checkbox" data-column="16"><label class="inline-label tr" key="Fecha Certificado de Destrucción" for="column_18">Fecha Certificado de Destrucción</label>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item">
                                <input class="toggle-vis" id="column_19" type="checkbox" data-column="17"><label class="inline-label tr" key="Fecha de Descontaminacion" for="column_19">Fecha de Descontaminacion</label>
                            </button>
                        </div>
                    </div>
                    <a href="{{ url('exportar-envios-semestrales')}}" class="btn btn-info mr-2 float-right">Exportar</a>
                </h5>     
  
                    <table style="width: 100%" id="tableEnviosSemestrales" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
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
<input id="url" type="hidden" value="{{ url('/envios-semestrales') }}">
{{ csrf_field() }}
<script src="{{ asset('assets/scripts/js/envios_semestrales.js') }}"></script>

@endsection