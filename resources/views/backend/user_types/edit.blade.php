@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Roles de Usuarios</span>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"
                        onclick="window.location.href='{{ url('user_types') }}'">
                        <i class="lnr-back btn-icon-wrapper"> </i>
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
                    <h5 class="card-title">Editar Rol</h5>
                    {!! Form::model($user_type, ['route' => ['user_types.update', $user_type->id], 'method' => 'put']) !!}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ $user_type->name }}"
                                required>

                            @if ($errors->has('name'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="position-relative form-group">
                            <label>Descripción</label>
                            <input class='form-control' id='description' name='description' type='text'
                                value="{{ $user_type->description }}" required>

                            @if ($errors->has('description'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
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
@endsection
