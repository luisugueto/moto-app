@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Tasación Motos
                <div class="page-title-subheading">Listado de datos.
                </div>
            </div>
        </div>
        <div class="page-title-actions">            
            <div class="d-inline-block dropdown">
                <a href="{{ url('purchase_valuation/create') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> <i class="pe-7s-plus btn-icon-wrapper"> </i>Nuevo</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Tasación Motos</h5>
                <table style="width: 100%;" id="tableTasacionMotos" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Modelo</th>
                            <th class="text-center">Año</th>
                            <th class="text-center">KM</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Provincia</th>
                            <th class="text-center">Estado en Tráfico</th>
                            <th class="text-center">Golpe Del.</th>
                            <th class="text-center">Golpe Tras</th>
                            <th class="text-center">Av. Elec</th>
                            <th class="text-center">Av. Mec</th>
                            <th class="text-center">Aband. Viejo</th>
                            <th class="text-center">Mínimo</th>
                            <th class="text-center">Observaciones</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase_valuation as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->status }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td>{{ $purchase->brand }}</td>
                                <td>{{ $purchase->model }}</td>
                                <td>{{ $purchase->year }}</td>
                                <td>{{ $purchase->km }}</td>
                                <td>{{ $purchase->name }} {{ $purchase->lastname }}</td>
                                <td>{{ $purchase->province }}</td>
                                <td>{{ $purchase->status_trafic }}</td>
                                <td>{{ ($purchase->g_del == 1) ? 'Si' : 'No' }}</td>
                                <td>{{ ($purchase->g_tras == 1) ? 'Si' : 'No' }}</td>
                                <td>{{ ($purchase->av_elec == 1) ? 'Si' : 'No' }}</td>
                                <td>{{ ($purchase->av_mec == 1) ? 'Si' : 'No' }}</td>
                                <td>{{ ($purchase->old == 1) ? 'Si' : 'No' }}</td>
                                <td>{{ $purchase->price_min }}</td>
                                <td>{{ $purchase->observations }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection