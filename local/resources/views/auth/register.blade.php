@extends('layouts.login')

@section('content')
<div class="modal-content">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        <div class="modal-body">
            <h5 class="modal-title">
                <h4 class="mt-2">
                    <div>Bienvenido,</div>
                    <span>Solo se necesitan <span class="text-success"> unos segundos </span> para crear su cuenta.</span>
                </h4>
            </h5>
            <div class="divider row"></div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="position-relative form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                          
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="roles" value="1">
            </div>
            <div class="divider row"></div>
            <h6 class="mb-0">¿Ya tienes una cuenta?
                <a href="{{ url('/login') }}" class="text-primary">Iniciar Sesión</a> | <a href="{{ url('/password/reset') }}" class="text-primary">Recuperar contraseña</a>
            </h6>
        </div>
        <div class="modal-footer d-block text-center">
            <button type="submit" class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">Crear una cuenta</button>
        </div>
    </form>
</div>
@endsection
