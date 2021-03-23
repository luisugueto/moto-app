@extends('layouts.backend')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
<div class="container-fluid">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        @if (isset($user->image))
                            <img  class="img-profile img-circle img-responsive center-block" src="{{ url('local/public/img_app/profile_images/'.$user->image) }}" alt="{{$user->name}}" title="{{$user->name}}">
                        @else
                            <img  class="img-profile img-circle img-responsive center-block" src="{{asset('assets/images/avatars/avatar1.png')}}" alt="Image" title="User Image">
                        @endif
                    </div>
            		<nav class="side-menu">
        				<ul class="nav nav-tabs">
        					<li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#tab-eg10-0" ><span class="fa fa-user"></span> Perfil</a></li>
        					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-eg10-1" id="tabChangePassword" ><span class="fa fa-cog"></span> Cambiar Contraseña</a></li>
        				</ul>
        			</nav>
                </div>
                <div class="content-panel tab-content">
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
                	<div class="tab-pane active" id="tab-eg10-0" role="tabpanel">
	                    <h2 class="title">Perfil</h2>
	                    <form class="needs-validationTwo form-horizontal" method="POST" action="{{ route('updateProfile') }}"
                        enctype='multipart/form-data'>
                        {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
	                        <fieldset class="fieldset">
	                            <h3 class="fieldset-title">Información de Contacto</h3>
                                <br>
	                            <div class="form-group">
	                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nombre</label>
	                                <div class="col-md-10 col-sm-9 col-xs-12">
	                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
	                                </div>
	                            </div>
                                <div class="form-group">
	                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Apellido</label>
	                                <div class="col-md-10 col-sm-9 col-xs-12">
	                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Teléfono</label>
	                                <div class="col-md-10 col-sm-9 col-xs-12">
	                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
	                                </div>
	                            </div>

	                            <div class='form-group'>
                                    <label for='userPicture' class='col-md-2 col-sm-3 col-xs-12 control-label'>Subir una Foto</label>
                                    <div class='col-md-10 col-sm-9 col-xs-12'>
                                        <div class="input-group">

                                            <input type="text" class="form-control" readonly>
                                            <label class="input-group-append" style="height: 38px;">
                                                <span class="btn btn-success">
                                                    Subir
                                                    <input type="file" style="display: none;" id='image' name='image'>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

	                        </fieldset>
	                        <hr>
	                        <div class="form-group">
	                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
	                                <button type="submit" class="btn btn-primary" id="btnSaveProfile">Actualizar Datos</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	                <div class="tab-pane" id="tab-eg10-1" role="tabpanel">
	                	<div class="fieldset">
	                        <h3 class="fieldset-title">Cambiar Contraseña</h3><br>
	                       <form class="form-horizontal" role="form" method="POST" action="{{ route('updatePassword') }}"
                            enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
	                        	<div class="position-relative form-group">
		                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">Contraseña Actual</label>
		                            <div class="col-md-10 col-sm-9 col-xs-12">
		                                <input class="form-control" id="current_password" name="current_password" type="password" value="" required="">
                                        @if ($errors->has('current_password'))
                                            <span class="error text-danger">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                        @endif
		                            </div>
		                        </div>
	                            <div class="position-relative form-group">
		                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">Nueva Contraseña</label>
		                            <div class="col-md-10 col-sm-9 col-xs-12">
		                                <input class="form-control" id="password" name="password" type="password" value="" required="">
		                            </div>
		                            @if ($errors->has('password'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
		                        </div>
		                        <div class="position-relative form-group">
		                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Confirmar Contraseña</label>
		                            <div class="col-md-10 col-sm-9 col-xs-12">
		                                <input class="form-control " id="reptyPassword" name="reptyPassword" type="password" value="" required="">
                                    </div>
                                    @if ($errors->has('reptyPassword'))
                                        <span class="error text-danger">
                                            <strong>{{ $errors->first('reptyPassword') }}</strong>
                                        </span>
                                    @endif

		                        </div>
		                        <hr>
		                        <div class="form-group">
		                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
		                                <button type="submit" class="btn btn-primary" id="btnSaveProfilePassword">Actualizar Cambios</button>
		                            </div>
		                        </div>
	                        </form>
	                    </div>
	                </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection