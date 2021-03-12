@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Estados</span>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"
                        onclick="window.location.href='{{ url('states') }}'">
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
                    <h5 class="card-title">Editar Estado</h5>
                    {!! Form::model($state, ['route' => ['states.update', $state->id], 'method' => 'put']) !!}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ $state->name }}"
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
                                value="{{ $state->description }}" required>

                            @if ($errors->has('description'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>   
                        
                        <div class="position-relative form-group">
                            <label for="email_id" class="">Plantilla Email</label>
                            <select class="form-control" name="email_id" id="email_id">
                                <option value="">Seleccione</option>
                                @foreach($emails as $email)
                                    <option value="{{ $email->id }}">{{ $email->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('email_id'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('email_id') }}</strong>
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
            $("#email_id").val({{ $state->email_id }});
        });

    </script>
@endsection
