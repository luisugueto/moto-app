@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Correos</span>
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de Correos</h5>
                    <table style="width: 100%;" id="tableEmails" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Asunto</th>
                                <th>Contenido</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                         
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('modals')
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">

    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario de Correos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmEmails" name="frmEmails" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Asunto</label>
                            <input class='form-control' id='subject' name='subject' type='text'
                                value="{{ old('subject') }}" required>
                        </div>  
                        <div class="position-relative form-group">
                            <label>Contenido</label>
                            <textarea class='form-control' id='content' name='content' type='text'
                                value="{{ old('content') }}" required></textarea>
                            {first_name} {last_name} {marca_moto} {modelo_moto} {direccion} {telefono}
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="type" name="type" value="2">
                    <input type="hidden" id="email_id" name="email_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/emails_business.js') }}"></script>
    @endsection

@endsection
