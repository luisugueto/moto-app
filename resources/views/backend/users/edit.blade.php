@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="site-action">
            <button onclick="window.location.href='{{ url('users') }}'"
                class="site-action-toggle btn-raised btn btn-info btn-floating" title="Regresar a la lista"><em
                    class="fa fa-reply animation-scale-up"></em></button>
        </div>
        <div class="panel panel-body center">
            <h4>Editar Usuario</h4>
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' =>
            'form-horizontal']) !!}
            {{ csrf_field() }}
            @include('errors.errors')
            <div class="form-group">
                <label class="control-label col-sm-2">Nombre</label>
                <div class="col-md-4">
                    <input class='form-control' id='name' name='name' type='text' value="{{ $user->name }}">
                </div>
                <label class="control-label col-sm-2">Apellido</label>
                <div class="col-md-4">
                    <input class='form-control' id='lastName' name='lastName' type='text' value="{{ $user->lastName }}">
                </div>
            </div>

            <div class='form-group'>
                <label for='profile_id' class='col-sm-2 control-label'>Perfil</label>
                <div class='col-sm-10'>
                    <select name="profile_id" id="profile_id" class="form-control" value="{{ old('profile_id') }}">
                        @foreach($profiles as $pro)
                        <option value="{{ $pro->id }}">{{ $pro->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class='form-group'>
                <label for='user' class='col-sm-2 control-label'>Nombre de usuario</label>
                <div class='col-sm-4'>
                    <input class='form-control' id='user' name='user' type='text' value="{{ $user->user }}">
                </div>

                <label for='email' class='col-sm-2 control-label'>Correo Electrónico</label>
                <div class='col-sm-4'>
                    <input class='form-control' id='email' name='email' type='email' value="{{ $user->email }}">
                </div>
            </div>

            <div class='form-group'>
                <label for='password' class='col-sm-2 control-label'>Contraseña</label>
                <div class='col-sm-10'>
                    <input class='form-control' id='password' name='password' type='password'
                        value="{{ $user->password }}">
                </div>
            </div>

            <div class='form-group '>
                <div class='col-sm-2'></div>
                <div class='col-sm-10'>
                    <button class='btn btn-primary  btn-raised ladda-button' data-style='expand-left'
                        data-plugin='ladda' id='save' name='Editar' type='submit'><em class='fa fa-save'></em> Editar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#profile_id").val({{ $user->profile_id }});
    });
</script>
@endsection