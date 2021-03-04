@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="site-action">
            <button onclick="window.location.href='{{ url('users') }}'"
                class="site-action-toggle btn-raised btn btn-info btn-floating" title="Regresar a la lista"><em
                    class="fa fa-reply animation-scale-up"></em></button>
        </div>
        <div class="panel panel-body">
            <h3>Nuevo Usuario</h3><br />
            {!! Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) !!}
            {{ csrf_field() }}
            @include('errors.errors')

            <div class="form-group">
                <label class="control-label col-sm-2">Nombre</label>
                <div class="col-md-4">
                    <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}" required>
                </div>
                <label class="control-label col-sm-2">Apellido</label>
                <div class="col-md-4">
                    <input class='form-control' id='lastName' name='lastName' type='text' value="{{ old('name') }}" required>
                </div>
            </div>

            <div class='form-group'>
                <label for='profile' class='col-sm-2 control-label'>Perfil</label>
                <div class='col-sm-10'>
                    <select name="profile_id" id="profile_id" class="form-control" value="{{ old('profile_id') }}">
                        @foreach($profiles as $pro)
                        <option value="{{ $pro->id }}" {{ old('profile_id') === $pro->id ? 'selected' : '' }}>{{ $pro->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class='form-group'>
                <label for='user' class='col-sm-2 control-label'>Nombre de usuario</label>
                <div class='col-sm-4'>
                    <input class='form-control' id='user' name='user' type='text' value="{{ old('user') }}" required>
                </div>

                <label for='email' class='col-sm-2 control-label'>Correo Electrónico</label>
                <div class='col-sm-4'>
                    <input class='form-control' id='email' name='email' type='email' value="{{ old('email') }}" required>
                </div>
            </div>

            <div class='form-group'>
                <label for='password' class='col-sm-2 control-label'>Contraseña</label>
                <div class='col-sm-10'>
                    <input class='form-control' id='password' name='password' type='password' value="{{ old('password') }}" required>
                </div>
            </div>

            <div class='form-group '>
                <div class='col-sm-2'></div>
                <div class='col-sm-10'>
                    <button class='btn btn-primary  btn-raised ladda-button' data-style='expand-left'
                        data-plugin='ladda' id='save' name='Registrar' type='submit'><em class='fa fa-save'></em>
                        Registrar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection