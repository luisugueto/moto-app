@extends('layouts.login')

@section('content')
<div class="modal-content">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="modal-header">
            <div class="h5 modal-title">Restablecer la contraseña
                <h6 class="mt-1 mb-0 opacity-8">
                    <span>Utilice el siguiente formulario para recuperarlo.</span>
                </h6>
            </div>
        </div>
        <div class="modal-body">
            <div>                    
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                </div>                    
            </div>
        </div>
        <div class="modal-footer clearfix">
            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-lg">Restablecer la contraseña</button>
            </div>
        </div>
    </form>
</div>
@endsection
