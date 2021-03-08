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
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"
                        onclick="window.location.href='{{ url('users') }}'">
                        <i class="lnr-undo btn-icon-wrapper"> </i>
                        <span>Regresar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Editar Usuario</h5>
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

                    <div class="divider"></div>
                    <div class="position-relative form-group">
                        <label>Nombre</label>
                        <input class='form-control' id='name' name='name' type='text' value="{{ $user->name }}" required>

                        @if ($errors->has('name'))
                            <span class="error text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="position-relative form-group">
                        <label>Apellido</label>
                        <input class='form-control' id='last_name' name='last_name' type='text'
                            value="{{ $user->last_name }}" required>

                        @if ($errors->has('last_name'))
                            <span class="error text-danger">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class='position-relative form-group'>
                        <label for='profile'>Rol</label>
                        <select name="user_type_id" id="user_type_id" class="form-control"
                            value="{{ old('user_type_id') }}">
                            @foreach ($user_types as $ut)
                                <option value="{{ $ut->id }}"
                                    {{ old('user_type_id') === $ut->id ? 'selected' : '' }}>{{ $ut->description }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_type_id'))
                            <span class="error text-danger">
                                <strong>{{ $errors->first('user_type_id') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class='position-relative form-group'>
                        <label for='email'>Correo Electrónico</label>
                        <input class='form-control' id='email' name='email' type='email' value="{{ $user->email }}"
                            required>
                        @if ($errors->has('email'))
                            <span class="error text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class='position-relative form-group'>
                        <label for='phone'>Teléfono</label>
                        <input class='form-control' id='phone' name='phone' type='text' value="{{ $user->phone }}"
                            required>
                        @if ($errors->has('phone'))
                            <span class="error text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class='position-relative form-group '>
                        <button class='btn btn-primary' type='submit'><i class='fa fa-save'></i>
                            Editar
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#user_type_id").val({{ $user->user_type_id }});
        });

    </script>
@endsection
