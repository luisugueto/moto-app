@extends('layouts.backend')

@section('content')

@if (session('notification'))
    <div class="alert alert-success notification">
        {{ session('notification') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-block notification">
        {{ session('error') }}
    </div>
    <br><br>
@endif

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
    <div class="col-md-12">
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
    
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
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
    
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Residuos Retirados
                        </h5>    
                            {!! Form::open(['url' => 'applyInf', 'method' => 'post']) !!} 
                                <div class="row">
                                    <div class="input-group col-md-6 position-relative">
                                        <select name="applyInf" class="custom-select custom-control custom-control-inline" id="applyInf">
                                            <option value="" disabled selected>Elegir tipo de Informe</option>
                                            <option value="np1">Proceso NP1</option>
                                            <option value="np2">Proceso NP2</option>
                                            <option value="np3">Proceso NP3</option>
                                            <option value="reu">Proceso de Reutilización</option>
                                        </select>

                                        <label style="margin-top: 10px; margin-right: 10px"><b>Desde:</b> </label><input type="date" name="start_at" title="Desde" value="{{ old('start_at') }}" class="custom-control custom-control-inline" required>
                                        <label style="margin-top: 10px; margin-right: 10px"><b>Hasta:</b> </label> <input type="date" name="end_at" title="Hasta" value="{{ old('end_at') }}" class="custom-control custom-control-inline" required>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Aplicar</button>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            <hr>
                            <table style="width: 100%" id="tableResiduosRetirados" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Residuo</th>
                                        <th>Entrega</th>
                                        <th>En Instalaciones</th>
                                        <th>DCS (Cuando lo entregan)</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>


<input id="url" type="hidden" value="{{ url('/retiro-residuos') }}">
{{ csrf_field() }}
    
    @section('modals')
        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editar Residuo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" hidden>
                            <ul id="errors"></ul>
                        </div>
                        <form id="frmAddEditResiduo" name="frmAddEditResiduo" novalidate="">
                            {{ csrf_field() }}
                            <div class="position-relative form-group">
                                <label>Entrega</label>
                                <input name="entrega" id="entrega" type="number" step="0.1" class="form-control" value="" required>
                            </div> 
                            <div class="position-relative form-group">
                                <label>En Instalaciones</label>
                                <input name="en_instalaciones" id="en_instalaciones" type="number" step="0.1" class="form-control" value="" required>
                            </div> 
                            <div class="position-relative form-group">
                                <label>DCS (Cuando lo entregan)</label>
                                <input name="dcs" id="dcs" type="text"  class="form-control" value="" required>
                            </div> 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn_edit_residuo" value="add">Guardar Cambios</button>
                        <input type="hidden" id="residuo_id" name="residuo_id" >
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/scripts/js/retiro_residuos.js') }}"></script>
    @endsection
@endsection