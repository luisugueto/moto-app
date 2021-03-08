@extends('layouts.login')

@section('content')
<div class="modal-content">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <div class="modal-header">
            <div class="h5 modal-title">¿Olvidaste tu contraseña?
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
                </div>                    
            </div>
            <div class="divider"></div>
            <h6 class="mb-0">
                <a href="{{ url('/login') }}" class="text-primary">Iniciar sesión en una cuenta existente</a>
            </h6>
        </div>
        <div class="modal-footer clearfix">
            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-lg">Enviar enlace de restablecimiento de contraseña</button>
            </div>
        </div>
    </form>
</div>
@endsection
