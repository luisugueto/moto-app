@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Empresas</span>
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de Empresas</h5>
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="tableBusiness">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Servicio</th>
                                <th>Plantilla de Email</th>
                                <th>Nombre</th>
                                <th>CIF</th>
                                <th>Email</th>                                
                                <th>City</th>
                                <th>Province</th>                                
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario Empresas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmBusiness" name="frmBusiness" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Servicio</label>
                            <select class="form-control" name="service_id" id="service_id" >
                                <option value="">Seleccione</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>       
                        <div class="position-relative form-group">
                            <label>CIF</label>
                            <input class='form-control' id='cif' name='cif' type='text'
                                value="{{ old('cif') }}" required>
                        </div>                 
                        <div class="position-relative form-group">
                            <label>Teléfono</label>
                            <input class='form-control' id='phone' name='phone' type='text' value="{{ old('phone') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Correo Electrónico</label>
                            <input class='form-control' id='email' name='email' type='text' value="{{ old('email') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Postal Code</label>
                            <input class='form-control' id='postal_code' name='postal_code' type='text' value="{{ old('postal_code') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Ciudad</label>
                            <input class='form-control' id='city' name='city' type='text' value="{{ old('city') }}"
                                required>
                        </div>

                        <div class="position-relative form-group">
                            <label>Provincia</label>
                            <input class='form-control' id='province' name='province' type='text' value="{{ old('province') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Dirección</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="business_id" name="business_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/business.js') }}"></script>
    @endsection
@endsection
