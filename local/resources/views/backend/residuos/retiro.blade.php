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
                <div class="page-title-subheading">Retiro de Residuos.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                <span>Retiro de Residuos</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                <span>Residuos Retirados</span>
            </a>
        </li>
    </ul>

    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Retiro de Residuos
                     <button type="button" id="btnRetiroAll" class="btn btn-primary mr-2 float-right">Retirar Varios</button>
                </h5>     

                    <table style="width: 100%" id="tableRetiroResiduos" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Residuo</th>
                                <th>Entrega</th>
                                <th>En Instalaciones</th>
                                <th>DCS (Cuando lo entregan)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                
            </div>
        </div>

    </div>
</div>
<input id="url" type="hidden" value="{{ url('/retiro-residuos') }}">
{{ csrf_field() }}
<script src="{{ asset('assets/scripts/js/retiro_residuos.js') }}"></script>

@endsection