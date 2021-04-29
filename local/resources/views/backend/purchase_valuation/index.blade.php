@extends('layouts.backend')

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-speaker icon-gradient bg-night-fade">
                </i>
            </div>
            <div>Tasación Motos
                <div class="page-title-subheading">Listado de datos.
                </div>
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
                <h5 class="card-title">Tasación Motos</h5>
                {!! Form::open(['url' => '', 'method' => 'post', 'id' => 'formTasacion']) !!}
                <div class="row">
                    <div class="input-group col-md-3">
                        <select name="applyState" class="custom-select" id="applyState" onChange="setApply();">
                            <option value="" disabled selected>Elegir Estado</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Aplicar</button>
                        </div>
                    </div>
                    <div class="input-group col-md-3">
                        <select name="applyProcess" class="custom-select" id="applyProcess" onChange="setApply();">
                            <option value="" disabled selected>Elegir Proceso</option>
                            @foreach($processes as $process)
                                <option value="{{ $process->id }}">{{ $process->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Aplicar</button>
                        </div>
                    </div>
                </div>
                <hr>
                <table width="100%" id="tableTasacionMotos" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Marca</th>
                            <th class="text-center">Modelo</th>
                            <th class="text-center">Año</th>
                            <th class="text-center">KM</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Provincia</th>
                            <th class="text-center">Estado en Tráfico</th>
                            <th class="text-center">Golpe Del.</th>
                            <th class="text-center">Golpe Tras</th>
                            <th class="text-center">Av. Elec</th>
                            <th class="text-center">Av. Mec</th>
                            <th class="text-center">Aband. Viejo</th>
                            <th class="text-center">Mínimo</th>
                            <th class="text-center">Observaciones</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                </table>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
 <!-- Passing BASE URL to AJAX -->
 <input id="url" type="hidden" value="{{ url('/motos-que-nos-ofrecen') }}">
    
 @section('modals')
 <div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Imagenes</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="notification alert alert-danger" hidden>
                     <ul id="errors"></ul>
                 </div>
                 <form id="frmImagesPurchaseValuation" name="frmImagesPurchaseValuation" novalidate="">
                     {{ csrf_field() }}
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="imagesCarrousel">
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <input type="hidden" id="image_id" name="image_id" value="0">
             </div>
         </div>
     </div>
 </div>

<!-- DOCUMENTOS -->

<div class="modal fade" id="modalDocument" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Agregar Documento</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="notification alert alert-danger" hidden>
                     <ul id="errors"></ul>
                 </div>
                 {!! Form::open(['url'=> 'uploadDocument', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                    <input type="hidden" id="purchase_id" name="id" value="0">
                    <div class="dz-message" style="height:200px;">
                        Arratre sus archivos aquí.
                    </div>
                    <div class="dropzone-previews"></div>
                    <button type="submit" class="btn btn-success" id="uploadDocument">Guardar</button>
                    {!! Form::close() !!}
             </div>
             <div class="modal-footer">

             </div>
         </div>
     </div>
 </div>



<!-- MODALLLLLLLLLLLLLLLLLLLLLLL -->

<div class="modal fade" id="modalPurchase" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Solicitud de venta de moto averiada o siniestrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" hidden>
                        <ul id="errors"></ul>
                    </div>
                    <form id="frmPurchase" name="frmPurchase" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de la moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="brand" class="">Marca:</label>
                                            <select class="form-control select" name="brand" id="brand" onChange="setModel()" style="width: 100%">
                                                <option value="" disabled selected="">Seleccione</option>
                                                @foreach($marcas as $marca)
                                                    <option data-id="{{ $marca->id_category }}" value="{{ $marca->marca }}">{{ $marca->marca }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('brand'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('brand') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="model" class="">Modelo:</label>
                                            <select class="form-control select" name="model" id="model" disabled  style="width: 100%">
                                                <option value="" disabled selected="">Seleccione</option>
                                            </select>
                                            @if ($errors->has('model'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('model') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="year" class="">Año:</label>
                                            <input name="year" id="year" type="date"
                                                class="form-control" value="{{ old('year') }}" required>
                                            @if ($errors->has('year'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="km" class="">KM:</label>
                                            <input name="km" id="km" type="text"
                                                class="form-control" value="{{ old('km') }}" required>
                                            @if ($errors->has('km'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('km') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de Contacto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="name" class="">Nombre:</label>
                                            <input name="name" id="name" type="text" class="form-control"
                                                value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="lastname" class="">Apellido:</label>
                                            <input name="lastname" id="lastname" type="text" class="form-control"
                                                value="{{ old('lastname') }}" required>
                                            @if ($errors->has('lastname'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="email" class="">Email:</label>
                                            <input name="email" id="email" type="text" class="form-control"
                                                value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                   
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="phone" class="">Teléfono:</label>
                                            <input name="phone" id="phone" type="text" class="form-control"
                                                value="{{ old('phone') }}" required>
                                            @if ($errors->has('phone'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="province" class="">Provincia:</label>
                                            <input name="province" id="province" type="province" class="form-control"
                                                value="{{ old('province') }}" required>
                                            @if ($errors->has('province'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Estado de la Moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="status_trafic" class="">Estado en tráfico: </label>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="high" name="status_trafic"
                                                    class="custom-control-input" value="Alta">
                                                <label class="custom-control-label" for="high">Alta</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="low" name="status_trafic"
                                                    class="custom-control-input" value="Baja definitiva">
                                                <label class="custom-control-label" for="low">Baja</label>
                                            </div>
                                            @if ($errors->has('status_trafic'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('status_trafic') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">Estado de la Moto: </label>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="g_del" name="g_del"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="g_del">Golpe Delantero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="g_tras" name="g_tras"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="g_tras">Golpe Trasero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_elec" name="av_elec"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="av_elec">Avería Eléctrica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_mec" name="av_mec"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="av_mec">Avería Mecánica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="old" name="old"
                                                    class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="old">Vieja o Abandonada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">Observaciones: </label>
                                            <textarea class="form-control" id="observations" name="observations"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">¿Cual es el precio mínimo que aceptas?: </label>
                                            <input type="number" step="any" class="form-control" id="price_min" name="price_min" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de Finalización</h5>
                            <div class="card-body" id="form_display_complement">
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar Cambios</button>
                    <input type="hidden" id="purchase_id" name="id" value="0">
                </div>
            </div>
        </div>
    </div>


<script>
        var setModel = () => {
        let id = $("#brand").find(':selected').data('id');

        $.ajax({
            url: '{{ url("getModel") }}',
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            data: {
                id:id
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (resp) {
                let select = $("#model").prop('disabled', 'disabled').empty().append("<option disabled='disabled' selected>Seleccione</option>");
                
                resp.model.forEach(function(model, index){
        
                    select.append($('<option>', {
                        value: model.marca,
                        text: model.marca
                    }));
                });

                select.prop('disabled', false);

            }
        });
    };
    </script>

 <script src="{{ asset('assets/scripts/js/purchase_valuation_images.js') }}"></script>
 @endsection

 <script src="{{ asset('assets/scripts/js/purchase_valuation.js') }}"></script>

    <script>
        var setApply = () => {
            if($("#applyState").val() != null && $('#applyProcess').val() != null)
            {
                $("#applyState").val(null);
                $('#applyProcess').val(null);
                $("#formTasacion").attr('action', '');
            }

            if($("#applyState").val() != null)
                $("#formTasacion").attr('action', 'applyState');

            if($('#applyProcess').val() != null)
                $("#formTasacion").attr('action', 'applyProcesses');;

        };
    </script>
 
@endsection