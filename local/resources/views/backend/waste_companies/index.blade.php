@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Empresas de Residuos</span>
                </div>
            </div>
            <div class="page-title-actions">
                @if ($haspermision)
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="btn_add" name="btn_add">
                        <i class="pe-7s-plus btn-icon-wrapper"> </i>
                        <span class="lang" key="new">Nueva</span>
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de Empresas Residuos</h5>
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="tableWasteCompanies">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre de la Empresa</th>
                                <th>NIF</th>
                                <th>Plantilla de Email</th>                                
                                <th>Razón social</th>
                                <th>NIMA </th>                                
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>N° de Autorización</th>                                                                
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario Empresas de Residuos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmWasteCompanies" name="frmWasteCompanies" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Plantilla de Email</label>
                            <select class="form-control" name="email_id" id="email_id" >
                                <option value="">Seleccione</option>
                                @foreach($emails as $email)
                                    <option value="{{ $email->id }}">{{ $email->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="position-relative form-group">
                            <label>Nombre Empresa</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>       
                        <div class="position-relative form-group">
                            <label>NIF de Inst. destino</label>
                            <input class='form-control' id='nif_inst_destination' name='nif_inst_destination' type='text'
                                value="{{ old('nif_inst_destination') }}" required>
                        </div>                 
                        <div class="position-relative form-group">
                            <label>Razón social de Inst. destino</label>
                            <input class='form-control' id='reason_social_inst_destination' name='reason_social_inst_destination' type='text' value="{{ old('reason_social_inst_destination') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>NIMA de la instalación destino</label>
                            <input class='form-control' id='nima_inst_destination' name='nima_inst_destination' type='text' value="{{ old('nima_inst_destination') }}"
                                required>
                        </div>
                        <div class="form-row row g-1">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="type_via" class="">Tipo Vía: </label>
                                    <input name="type_via" id="type_via" type="text" class="form-control"
                                        value="{{ old('type_via') }}">
                                    @if ($errors->has('type_via'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('type_via') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="name_via" class="">Nombre vía </label>
                                    <input name="name_via" id="name_via" type="text" class="form-control"
                                        value="{{ old('name_via') }}">
                                    @if ($errors->has('name_via'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('name_via') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="nro_street" class="">N°:</label>
                                    <input name="nro_street" id="nro_street" type="number" class="form-control"
                                        value="{{ old('nro_street') }}">
                                    @if ($errors->has('nro_street'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('nro_street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="flat" class="">Piso:</label>
                                    <input name="flat" id="flat" type="number" class="form-control"
                                        value="{{ old('flat') }}">
                                    @if ($errors->has('flat'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('flat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="door" class="">Puerta:</label>
                                    <input name="door" id="door" type="text" class="form-control"
                                        value="{{ old('door') }}">
                                    @if ($errors->has('door'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('door') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="postal_code" class="">Codigo Postal:</label>
                                    <input name="postal_code" id="postal_code" type="text" class="form-control"
                                        value="{{ old('postal_code') }}">
                                    @if ($errors->has('postal_code'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span>
                                    @endif
                                </div>   
                            </div>
                        </div>                        
                       
                                         
                        
                        <div class="position-relative form-group">
                            <label for="location" class="">Localidad:</label>
                            <input name="location" id="location" type="text" class="form-control"
                                value="{{ old('location') }}">
                            @if ($errors->has('location'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>                        
                       
                        <div class="position-relative form-group">
                            <label for="province" class="">Provincia:</label>
                            <input name="province" id="province" type="text" class="form-control"
                                value="{{ old('province') }}">
                            @if ($errors->has('province'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('province') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <div class="position-relative form-group">
                            <label>País</label>
                            <input class='form-control' id='country' name='country' type='text' value="{{ old('country') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>N° de Autorización</label>
                            <input class='form-control' id='authorization_no' name='authorization_no' type='text' value="{{ old('authorization_no') }}"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="waste_companies_id" name="waste_companies_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModalMaterials" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Materiales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmAddMaterials" name="frmAddMaterials" novalidate="">
                        {{ csrf_field() }}
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped table-hover" id="tdListMaterials" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>LER</th>
                                        <th>Material</th>
                                        <th>Ud. Media</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                {{-- <tbody id="tdListMaterials">
                                                                                
                                </tbody> --}}
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save-materials" value="add">Guardar Cambios</button>
                    <input type="hidden" id="waste_companies_2_id" name="waste_companies_2_id" >
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/waste_companies.js') }}"></script>
    @endsection
@endsection
