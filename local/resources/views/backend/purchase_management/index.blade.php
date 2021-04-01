@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Gestion de Compra
                <div class="page-title-subheading">Listado de datos.
                </div>
            </div>
        </div>
        <div class="page-title-actions">            
            <div class="d-inline-block dropdown">
                <a href="{{ url('purchase_management/create') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> <i class="pe-7s-plus btn-icon-wrapper"> </i>Nueva</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if (session('notification'))
            <div class="alert alert-success notification">
                {{ session('notification') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-block notification">
                {{ session('error') }}
            </div>
        @endif
        <br>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Gestion de Compra</h5>
                <table style="width: 100%;" id="tableGestionCompras" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Nº Expediente</th>
                            <th class="text-center">Propietario</th>
                            <th class="text-center">Dni/nif</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Representante</th>                            
                            <th class="text-center">Matricula</th>
                            <th class="text-center">Est.Tráfico</th>
                            <th class="text-center">Est.Vehículo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                             
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection