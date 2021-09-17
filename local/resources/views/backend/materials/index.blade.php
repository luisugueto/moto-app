@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Materiales de Empresas de Residuos</span>
                </div>
            </div>
            <div class="page-title-actions">
                @if ($haspermision)
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="btn_add" name="btn_add">
                        <i class="pe-7s-plus btn-icon-wrapper"> </i>
                        <span class="lang" key="new">Nuevo</span>
                    </button>
                </div>
                @endif
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de Materiales Empresas de Residuos</h5>
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="tableMaterials">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>LER</th>
                                <th>Código</th>
                                <th>Descripción</th>  
                                <th>Valorización</th>
                                <th>Ud. medida</th>
                                <th>Tipo</th>
                                <th>% (Porcentaje)</th>                                                                       
                                <th>Opciones</th>
                            </tr>
                        </thead> 
                    </table>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario de Materiales Empresas de Residuos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmMaterials" name="frmMaterials" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group row">
                        
                            <div class="col-md-6 position-relative form-group">
                                <label>LER</label>
                                <input class='form-control' id='LER' name='LER' type='text' value="{{ old('LER') }}"
                                    required>
                            </div>       
                            <div class="col-md-6 position-relative form-group">
                                <label>Código</label>
                                <input class='form-control' id='code' name='code' type='text' value="{{ old('code') }}">
                            </div> 
                        </div>
                        <div class="position-relative form-group">
                            <label>Descripción</label>
                            <input class='form-control' id='description' name='description' type='text' value="{{ old('description') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Valorización</label>
                            <input class='form-control' id='valorization' name='valorization' type='text' value="{{ old('valorization') }}">
                        </div>
                        <div class="position-relative form-group row">                        
                            <div class="col-md-6 position-relative form-group">
                                <label>Unidad de medida</label>
                                <input class='form-control' id='unit_of_measurement' name='unit_of_measurement' type='text' value="{{ old('unit_of_measurement') }}"
                                    required>
                            </div>       
                            <div class="col-md-6 position-relative form-group">
                                <label>% (Porcentaje)</label>
                                <input class='form-control' id='percent_formula' name='percent_formula' type='text' value="{{ old('percent_formula') }}"
                                    required>
                            </div> 
                        </div>   
                        <div class="position-relative form-group">
                            <label>Proceso en Residuos</label>
                            <select name="type[]" id="type" class="form-control" multiple required>
                                <option value="NP1">NP1</option>
                                <option value="NP2">NP2</option>
                                <option value="NP3">NP3</option>
                                <option value="Reutilizacion">Reutilización</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="material_id" name="material_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/materials.js') }}"></script>
    @endsection
@endsection
