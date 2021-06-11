@extends('layouts.backend')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div><span class="lang" key="heading">SubProcesos</span>
                </div>
            </div>
            <div class="page-title-actions">
                @if ($haspermision)
                <div class="d-inline-block dropdown">
                    <button class="mb-2 mr-2 btn-icon btn-pill btn btn-primary" id="btn_add" name="btn_add">
                        <i class="pe-7s-plus btn-icon-wrapper"> </i>
                        <span class="lang" key="new">Nuevo</span>
                    </button>
                </div>
                @endif
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
                    <h5 class="card-title lang" key="heading">Mantenimiento de SubProcesos</h5>
                    <table style="width: 100%;" class="table table-hover table-striped table-bordered" id="tableSubProcesses">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Status</th>
                                <th>Proceso</th>
                                <th>Plantilla Email</th>
                                <th>Opciones</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    {{ csrf_field() }}
    @section('modals')
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Formulario Sub-Procesos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmSubProcess" name="frmSubProcess" novalidate="">
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
                            <label>Proceso</label>
                            <select class="form-control" id="processes_id" name="processes_id" required>
                                <option selected disabled>Seleccione</option>
                                @foreach($processes as $process)
                                    <option value="{{ $process->id }}" data-name="{{ $process->name }}">{{ $process->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="position-relative form-group" style="display: none" id="check_business">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="is_business" id="is_business">
                              <label class="form-check-label">El subproceso es para una empresa ? </label>
                            </div>
                        </div>
                        <div class="position-relative form-group" id="business_select" style="display: none">
                            <label>Nombre de la Empresa</label>
                            <select class="form-control" id="business_id" name="business_id" required>
                                <option selected disabled>Seleccione</option>
                                @foreach($business as $busines)
                                    <option value="{{ $busines->id }}">{{ $busines->name }} | {{ $busines->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="position-relative form-group">
                            <label>Plantilla Email</label>
                            <select class="form-control" id="email_id" name="email_id" required>
                                <option selected disabled>Seleccione</option>
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
                    <input type="hidden" id="subprocess_id" name="subprocess_id" value="0">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/js/subprocesses.js') }}"></script>
    <script>
        $(function(){
            $('#processes_id').change(function(){
                var $proceso = $(this).find('option:selected').text();
                if($proceso == 'Grua')
                    $('#check_business').css('display', 'block'),
                    $('#email_id').prop('disabled',true);
                else
                    $('#check_business').css('display', 'none'),
                    $('#email_id').prop('disabled',false);
                
            });

            $('input[name="is_business"]').click(function(){
                if($(this).prop("checked") == true){
                    $('#business_select').css('display', 'block');
                }
                else if($(this).prop("checked") == false){
                    $('#business_select').css('display', 'none');
                }
            });

            $('#business_id').change(function(){
                var empresa = $(this).val();

                $.ajax({
                    url: '{{ url("getMailBusiness") }}',
                    headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
                    data: {
                        id:empresa
                    },
                    type: 'POST',
                    datatype: 'JSON',
                    success: function (resp) {
                        let select = $("#email_id");                        
                         
                        select.val(resp.email.id).trigger('change');

                        select.prop('disabled', true);

                    }
                });
            });
        });
    </script>
    @endsection
@endsection