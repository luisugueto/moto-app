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
                <h5 class="card-title">Tasación Motos</h5>
                {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'formTasacion']) !!}
                <div class="row">
                    <div class="input-group col-md-3">
                        <select name="applyState" class="custom-select" id="applyState" onChange="setApply();">
                            <option value="" disabled selected>Elegir Estado</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Aplicar</button>
                        </div>
                    </div>
                    <div class="input-group col-md-3">
                        <select name="applyProcess" class="custom-select" id="applyProcess" onChange="setApply();">
                            <option value="" disabled selected>Elegir Proceso</option>
                            @foreach($processes as $process)
                                <option value="{{ $process->id }}">{{ $process->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Aplicar</button>
                        </div>
                    </div>
                </div>
                <hr>
                <table width="100%" id="tableTasacionMotos" class="table table-hover table-striped table-bordered pag-table">
                    <thead>
                        <tr>
                            <th></th>
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
                                <td><input type="checkbox" name="apply[]" id="apply" value="{{ $purchase->id }}"></td>
                                <td>{{ $purchase->id }}</td>
                                @if($purchase->states_id == 0)
                                    <td>En Revisión</td>
                                @else
                                    <td>{{ $purchase->state->name }}</td>
                                @endif
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
                                <td>
                                    <a class="btn btn-warning" href="{{ url('purchase_valuation/' . $purchase->id . '/edit') }}">Editar</a>
                                    <button type="button" class="btn btn-info show-images" value="{{$purchase->id}}">Ver Imagenes</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
 <!-- Passing BASE URL to AJAX -->
 <input id="url" type="hidden" value="{{ \Request::url() }}">
    
 @section('modals')
 <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Imagenes</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="notification alert alert-danger" hidden>
                     <ul id="errors"></ul>
                 </div>
                 <form id="frmImagesPurchaseValuation" name="frmImagesPurchaseValuation" novalidate="">
                     {{ csrf_field() }}
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="imagesCarrousel">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <input type="hidden" id="image_id" name="image_id" value="0">
             </div>
         </div>
     </div>
 </div>
 <script src="{{ asset('assets/scripts/js/purchase_valuation_images.js') }}"></script>
 @endsection

    <script>
        var setApply = () => {
            if($("#applyState").val() != null && $('#applyProcess').val() != null)
            {
                $("#applyState").val(null);
                $('#applyProcess').val(null);
                $("#formTasacion").attr('action', '');
            }

            if($("#applyState").val() != null)
                $("#formTasacion").attr('action', 'applyState');

            if($('#applyProcess').val() != null)
                $("#formTasacion").attr('action', 'applyProcesses');;

        };
    </script>
 
@endsection