@extends('layouts.backend')

@section('content')
<style>
    .ocultar{
  display:none;
}
.disable {
  opacity: 0.4;
  pointer-events: none;
}
.disable div,
.disable textarea {
  overflow: hidden;
}
.disable input{
    
}
</style>

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
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        {{-- {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'formTasacion']) !!} --}}
        <div class="row">
            <div class="input-group col-md-3">
                <select name="applyState" class="custom-select" id="applyState">
                    <option value="" disabled selected>Elegir Destino de la Moto</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="btnApplyState">Aplicar</button>
                </div>
            </div>
        </div>
        {{-- {!! Form::close() !!} --}}
        <br>
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
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>En Revisón</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Interesa</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                    <span>Desguace</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3">
                    <span>Venta</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-4" data-toggle="tab" href="#tab-content-4">
                    <span>Subasta</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-5" data-toggle="tab" href="#tab-content-5">
                    <span>No Interesan</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-6" data-toggle="tab" href="#tab-content-6">
                    <span>Desguazadas</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-7" data-toggle="tab" href="#tab-content-7">
                    <span>Vendidas</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-8" data-toggle="tab" href="#tab-content-8">
                    <span>Subastadas</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-9" data-toggle="tab" href="#tab-content-9">
                    <span>Sin Acuerdo</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que nos ofrecen en revisión 
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_2" type="checkbox" data-column="2"><label class="inline-label tr" key="Fecha" for="column_2">Fecha</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_3" type="checkbox" data-column="3"><label class="inline-label tr" key="Marca" for="column_3">Marca</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_4" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Modelo" for="column_4">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_5" type="checkbox" data-column="5" checked><label class="inline-label tr" key="Año" for="column_5">Año</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_6" type="checkbox" data-column="6"><label class="inline-label tr" key="KM" for="column_6">KM</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_7" type="checkbox" data-column="7"><label class="inline-label tr" key="Email/Teléfono" for="column_7">Email/Teléfono</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_8" type="checkbox" data-column="8"><label class="inline-label tr" key="Nombre" for="column_8">Nombre</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_9" type="checkbox" data-column="9"><label class="inline-label tr" key="Provincia" for="column_9">Provincia</label>
                                    </button>
                                     <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_10" type="checkbox" data-column="10"><label class="inline-label tr" key="Estado en Tráfico" for="column_10">Estado en Tráfico</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_11" type="checkbox" data-column="11"><label class="inline-label tr" key="Estado de la moto." for="column_11">Estado de la moto.</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis" id="column_12" type="checkbox" data-column="12"><label class="inline-label tr" key="Mínimo" for="column_12">Mínimo</label>
                                    </button>
                                </div>
                            </div>
                        </h5>                     
                        <br><br>
                        <table width="100%" id="tableTasacionMotos" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    <th class="text-center">KM</th>
                                    <th class="text-center">Email/Teléfono</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Provincia</th>
                                    <th class="text-center">Estado en Tráfico</th>
                                    <th class="text-center">Estado de la moto</th>
                                    <th class="text-center">Mínimo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
             <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que Interesan
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_1-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_1-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-1" id="column_1-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_1-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-1" id="column_1-{{$i}}" type="checkbox" data-column="{{$i}}" ><label class="inline-label tr" key="{{$item->name}}" for="column_1-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach
                                </div>
                            </div>                           
                        </h5>  
                                             
                        <br><br>
                        <table width="100%" id="tableMotosQueInterensan" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>                
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos para Desguace
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-2" id="column_2-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_2-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-2" id="column_2-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_2-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        @if ($item->name == 'Recepción Moto' || $item->name == 'Arranque' || $item->name == 'Inventario' || $item->name == 'Recogida de la moto' || $item->name == 'Prioridad' || $item->name == 'Bastidor'  )   
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <input class="toggle-vis-2" id="column_2-{{$i}}" type="checkbox" data-column="{{$i}}" checked><label class="inline-label tr" key="{{$item->name}}" for="column_2-{{$i}}">{{$item->name}}</label>
                                            </button>
                                        @else
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <input class="toggle-vis-2" id="column_2-{{$i}}" type="checkbox" data-column="{{$i}}" ><label class="inline-label tr" key="{{$item->name}}" for="column_2-{{$i}}">{{$item->name}}</label>
                                            </button>
                                        @endif
                                        @php  $i++; @endphp
                                     @endforeach                                    
                                </div>
                            </div>      
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosParaDesguace" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>    
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que para Venta
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-3" id="column_3-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_3-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-3" id="column_3-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_3-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-3" id="column_3-{{$i}}" type="checkbox" data-column="{{$i}}" ><label class="inline-label tr" key="{{$item->name}}" for="column_3-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach  
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosParaVenta" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que para Subasta
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-4" id="column_4-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_4-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-4" id="column_4-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_4-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-4" id="column_4-{{$i}}" type="checkbox" data-column="{{$i}}" ><label class="inline-label tr" key="{{$item->name}}" for="column_4-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach                                    
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosParaSubasta" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-5" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que No Interesan
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_5-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_5-3">Año</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-4" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Fecha" for="column_5-4">Mínimo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-5" type="checkbox" data-column="5" checked><label class="inline-label tr" key="Fecha" for="column_5-5">Fecha</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-6" type="checkbox" data-column="6" checked><label class="inline-label tr" key="Fecha" for="column_5-6">Estado de la moto</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-7" type="checkbox" data-column="7" checked><label class="inline-label tr" key="Fecha" for="column_5-7">Provincia</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-5" id="column_5-8" type="checkbox" data-column="8" checked><label class="inline-label tr" key="Fecha" for="column_5-8">Télefono</label>
                                    </button>                                 
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosQueNoInteresan" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    <th class="text-center">Mínimo</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Estado de la moto</th>
                                    <th class="text-center">Provincia</th>
                                    <th class="text-center">Télefono</th>
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-6" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que has sido Desguazadas
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-6" id="column_6-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_6-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-6" id="column_6-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_6-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-6" id="column_6-{{$i}}" type="checkbox" data-column="{{$i}}" checked><label class="inline-label tr" key="{{$item->name}}" for="column_6-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach                                     
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosDesguazadas" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-7" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que has sido Vendidas
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-7" id="column_7-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_7-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-7" id="column_7-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_7-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-7" id="column_7-{{$i}}" type="checkbox" data-column="{{$i}}" checked><label class="inline-label tr" key="{{$item->name}}" for="column_7-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach                                     
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosVendidas" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-8" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos que has sido Subastadas
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-8" id="column_8-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_8-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-8" id="column_8-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_8-3">Año</label>
                                    </button>
                                    @php $i = 4; @endphp
                                    @foreach ($processes as $item)
                                        <button type="button" tabindex="0" class="dropdown-item">
                                            <input class="toggle-vis-8" id="column_8-{{$i}}" type="checkbox" data-column="{{$i}}" checked><label class="inline-label tr" key="{{$item->name}}" for="column_8-{{$i}}">{{$item->name}}</label>
                                        </button>
                                        @php  $i++; @endphp
                                     @endforeach                                     
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosSubastadas" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    @foreach ($processes as $process)
                                    <th class="text-center">{{ $process->name }}</th>
                                    @endforeach
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-9" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Motos Sin Acuerdo
                            <div class="mb-2 mr-2 btn-group float-right">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-toggle="dropdown" class="dropdown-toggle btn btn-primary">Columnas Plegables
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-2" type="checkbox" data-column="2" checked><label class="inline-label tr" key="Fecha" for="column_9-2">Modelo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-3" type="checkbox" data-column="3" checked><label class="inline-label tr" key="Fecha" for="column_9-3">Año</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-4" type="checkbox" data-column="4" checked><label class="inline-label tr" key="Fecha" for="column_9-4">Mínimo</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-5" type="checkbox" data-column="5" checked><label class="inline-label tr" key="Fecha" for="column_9-5">Fecha</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-6" type="checkbox" data-column="6" checked><label class="inline-label tr" key="Fecha" for="column_9-6">Estado de la moto</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-7" type="checkbox" data-column="7" checked><label class="inline-label tr" key="Fecha" for="column_9-7">Provincia</label>
                                    </button>
                                    <button type="button" tabindex="0" class="dropdown-item">
                                        <input class="toggle-vis-9" id="column_9-8" type="checkbox" data-column="8" checked><label class="inline-label tr" key="Fecha" for="column_9-8">Télefono</label>
                                    </button>                                 
                                </div>
                            </div>   
                        </h5>                       
                        <br><br>
                        <table width="100%" id="tableMotosSinAcuerdo" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id Moto</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Año</th>
                                    <th class="text-center">Mínimo</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Estado de la moto</th>
                                    <th class="text-center">Provincia</th>
                                    <th class="text-center">Télefono</th>
                                    <th class="text-center">Estado Ficha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                </div> 
            </div>
        </div>
        
        
    </div>
</div>
 <!-- Passing BASE URL to AJAX -->
 <input id="url" type="hidden" value="{{ url('/motos-que-nos-ofrecen') }}">
    
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


<!-- MODALLLLLLLLLLLLLLLLLLLLLLL -->

<div class="modal fade" id="modalPurchase" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Datos de la Moto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none">
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmPurchase" name="frmPurchase" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de la moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
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
                                            <button type="button" id="ver" class="btn btn-danger form-control pull-left">No encuentro Modelo/marca</button>
                                        </div>
                                    </div>

                                    <input type="hidden" name="exist_model_brand" id="exist_model_brand" value="0">
                                    
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="year" class="">Año:</label>
                                            <select name="year" id="year" class="form-control" value="{{ old('year') }}" required></select>
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
                        </div>
                        <div class="divider"></div>
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de Contacto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
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
                                            <input name="phone" id="phone" title="Ejemplo: +34620515223" pattern="^\+[1-9]{1}[0-9]{3,14}$" type="text" class="form-control"
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
                        </div>
                        <div class="divider"></div>
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Estado de la Moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
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
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">¿Cual es el precio mínimo que aceptas?: </label>
                                            <input type="number" step="any" class="form-control" id="price_min" name="price_min" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">Observaciones: </label>
                                            <textarea class="form-control" id="observations" name="observations"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row" id="images">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de Finalización</h5>
                            <div class="card-body" id="form_display_complement">
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="purchase_id" name="id" value="0">
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    let startYear = 1800;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--)
    {
        $('#year').append($('<option />').val(i).html(i));
    }
</script>

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

 <script type="text/javascript" src="{{ asset('assets/scripts/js/purchase_valuation.js') }}"></script>

   <!--  <script>
        var setApply = () => {
            if($("#applyState").val() != null && $('#applyProcess').val() != null)
            {
                $("#applyState").val(null);
                $('#applyProcess').val(null);
                $("#formTasacion").val('');
            }

            if($("#applyState").val() != null)
                $("#formTasacion").val('applyState');

            if($('#applyProcess').val() != null)
                $("#formTasacion").val('applyProcesses');

        };
    </script> -->
 
@endsection