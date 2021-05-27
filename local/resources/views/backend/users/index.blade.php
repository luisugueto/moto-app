@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Usuarios</span>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    @if ($haspermision)
                        <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="btn_add" name="btn_add">
                            <i class="pe-7s-plus btn-icon-wrapper"> </i>
                            <span class="lang" key="new">Nuevo</span>
                        </button>   
                    @endif
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de Usuarios
                        <button class="float-right btn btn-light" id="btn_refresh" name="btn_refresh"><i class="pe-7s-refresh"></i> Actualizar</button>                                             
                    </h5>
                    <table style="width: 100%;" id="tableUsers" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>                
                                <th>No</th>                
                                <th style="width: 200px">Nombre</th>                
                                <th style="width: 200px">Email</th>                
                                <th>Perfil</th>    
                                <th>Estado</th>             
                                <th width="160px">Optiones</th>                
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
    <input id="url_base" type="hidden" value="{{ url('/') }}">

    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario de Usuarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmUsers" name="frmUsers" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Apellido</label>
                            <input class='form-control' id='last_name' name='last_name' type='text'
                                value="{{ old('last_name') }}" required>
                        </div>

                        <div class='position-relative form-group'>
                            <label for='email'>Correo Electrónico</label>
                            <input class='form-control' id='email' name='email' type='email' value="{{ old('email') }}" required>
                        </div>
                        <div class='position-relative form-group'>
                            <img src="" alt="" class="img-thumbnail previsualizar" width="150" height="150">
                             
                        </div>
                        <div class='position-relative form-group'>                                    
                            <label for='userPicture' class=''>Subir una Foto</label>                                
                            <div class="input-group">
                                <input type="text" class="form-control upload-drag" readonly>
                                <label class="input-group-append" style="height: 38px;">
                                    <span class="btn btn-success">
                                        Subir
                                        <input type="file" style="display: none;" id='image' name='image'>
                                    </span>
                                </label>
                            </div>                                    
                        </div>                           
                        
                        <div class='position-relative form-group'>
                            <label for='phone'>Teléfono</label>
                            <input class='form-control' id='phone' name='phone' type='text' value="{{ old('phone') }}" required>
                        </div>

                        <div class='position-relative form-group hide'>
                            <label for='password'>Contraseña</label>
                            <input class='form-control' id='password' name='password' type='password' value="{{ old('password') }}" required>
                        </div>

                        <div class='position-relative form-group hide'>
                            <label for='password'>Confirmar Contraseña</label>
                            <input class='form-control' id='confirm-password' name='confirm-password' type='password' value="{{ old('confirm-password') }}" required>
                        </div>
                        
                        <div class='position-relative form-group'>
                            <label for='role'>Rol</label>
                            {!! Form::select('roles', $roles,[], array('class' => 'custom-select', 'id' => 'rol_id')) !!}
                        </div>   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="user_id" name="user_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/users.js') }}"></script>
    @endsection
@endsection
