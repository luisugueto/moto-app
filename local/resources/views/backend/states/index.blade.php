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
                        onclick="window.location.href='{{ url('states/create') }}'">
                        <i class="pe-7s-plus btn-icon-wrapper"> </i>
                        <span class="lang" key="new">Nuevo</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if (session('notification'))
                <div class="alert alert-success notification">
                    {{ session('notification') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-block notification">
                    {{ session('error') }}
                </div>
            @endif
            <br>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title lang" key="heading">Mantenimiento de Estados</h5>
                    <table style="width: 100%;" id="tableStates" class="table table-hover table-striped table-bordered pag-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Status</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $state)
                                <tr>
                                    <td>{{ strtoupper($state->name) }}</td>
                                    <td>{{ strtoupper($state->description) }}</td>
                                    <td>
                                        @if($state->status == 1)
                                        <form action="{{ route('changeStatusStates', $state->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-success btn-xs" name="changeStatus"
                                                value="0">Activo</button>
                                        </form>
                                        @else
                                        <form action="{{ route('changeStatusStates', $state->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-secondary btn-xs" name="changeStatus"
                                                value="1">Inactivo</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['states.destroy', $state->id], 'method' => 'delete']) !!}
                                        <a class="btn btn-warning" href="{{ url('states/' . $state->id . '/edit') }}">
                                            Editar</a>
                                        <button class="btn btn-danger delete"
                                            onclick="return confirm('¿Estás seguro de querer eliminar este registro?')">
                                            Eliminar</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
