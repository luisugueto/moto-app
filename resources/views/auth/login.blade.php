@extends('layouts.login')

@section('content') 
    <div class="modal-content">
        <form class="" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
            <div class="modal-body">
                <div class="h5 modal-title text-center">
                    <h4 class="mt-2 mb-3">
                        <div>Bienvenido de nuevo,</div>
                        <span>Inicie sesión en su cuenta a continuación</span>
                    </h4>
                </div>
                
                    <div class="form-row">
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
                    </div>
                    <div class="position-relative form-check">
                        <input name="remember" id="exampleCheck" type="checkbox" class="form-check-input">
                        <label for="exampleCheck" class="form-check-label">Mantenme conectado</label>
                    </div>
                
                <div class="divider"></div>
                <h6 class="mb-0">¿Sin cuenta? <a href="{{ url('/register') }}" class="text-primary">Registrarse aquí</a></h6>
            </div>
            <div class="modal-footer clearfix">
                <div class="float-left">
                    <a href="{{ url('/password/reset') }}" class="btn-lg btn btn-link">Recuperar Contraseña</a>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </div>
        </form>
    </div>                     
@endsection
