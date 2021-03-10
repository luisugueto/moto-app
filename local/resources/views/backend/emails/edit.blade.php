@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">Correos</span>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"
                        onclick="window.location.href='{{ url('emails') }}'">
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
                    <h5 class="card-title">Editar Correo</h5>
                    {!! Form::model($email, ['route' => ['emails.update', $email->id], 'method' => 'put', 'enctype' =>
            'multipart/form-data', 'class' => 'form-horizontal']) !!}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ $email->name }}"
                                required>

                            @if ($errors->has('name'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="position-relative form-group">
                            <label>Asunto</label>
                            <input class='form-control' id='subject' name='subject' type='text'
                                value="{{ $email->subject }}" required>

                            @if ($errors->has('subject'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>  

                        <div class="position-relative form-group">
                            <label>Contenido</label>
                            <textarea class='form-control' id='content' name='content' type='text' required>{{ $email->content }}</textarea>

                            @if ($errors->has('content'))
                                <span class="error text-danger">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                            {first_name} {last_name} {marca_moto} {modelo_moto}
                        </div>                        

                        <div class='position-relative form-group '>
                            <button class='btn btn-primary' type='submit'><i class='fa fa-save'></i>
                                Editar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
