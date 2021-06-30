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
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>                                                                      
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
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>       
                        <div class="position-relative form-group">
                            <label>Tipo</label>
                            <select name="type" id="type" class="custom-select" required>
                                <option value="">Seleccionar</option>
                                <option value="Plásticos" {{ old('type') == 'Plásticos' ? 'selected' : '' }}>Plásticos de gran tamaño</option>
                                <option value="Metal" {{ old('type') == 'Metal' ? 'selected' : '' }}>Metal</option>
                            </select>
                        </div>  
                         
                        <div class="position-relative form-group">
                            <label for="stock" class="">Stock:</label>
                            <input name="stock" id="stock" type="number" class="form-control"
                                value="{{ old('stock') }}">
                            @if ($errors->has('stock'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('stock') }}</strong>
                                </span>
                            @endif
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
