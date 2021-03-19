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
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="btn_add" name="btn_add">
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
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered pag-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Plantilla Email</th>
                                <th>Status</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="states-list" name="states-list">
                            @foreach ($states as $state)
                              <tr id="state{{$state->id}}" class="active">
                                  <td>{{$state->id}}</td>
                                  <td>{{$state->name}}</td>
                                  <td>{{$state->description}}</td>
                                  <td>{{$state->email->name}}</td>
                                  @if ($state->status == 1)
                                  <td><span class="badge badge-success">Activo</span></td>
                                  @else
                                  <td><span class="badge badge-danger">Inactivo</span></td>
                                  @endif
                                  <td width="35%">
                                      <button class="btn btn-warning btn-detail open_modal" value="{{$state->id}}">Editar</button>
                                      <button class="btn btn-danger btn-delete delete-state" value="{{$state->id}}">Eliminar</button>
                                  </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    
    @section('modals')
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario de Estados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notification alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmStates" name="frmStates" novalidate="">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="position-relative form-group">
                            <label>Nombre</label>
                            <input class='form-control' id='name' name='name' type='text' value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="position-relative form-group">
                            <label>Descripción</label>
                            <input class='form-control' id='description' name='description' type='text'
                                value="{{ old('description') }}" required>
                        </div>
                        <div class="position-relative form-group">
                            <label for="email_id" class="">Plantilla Email</label>
                            <select class="form-control" name="email_id" id="email_id" >
                                <option value="">Seleccione</option>
                                @foreach($emails as $email)
                                    <option value="{{ $email->id }}">{{ $email->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="position-relative form-group">
                            <label for="status" class="">Estado</label>
                            <select name="status" id="status" class="custom-select" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="state_id" name="state_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/states.js') }}"></script>
    @endsection
@endsection
