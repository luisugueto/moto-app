@extends('layouts.outside')

@section('content')
<style>
    .hidden{
  display:none;
}
.disable {
  opacity: 0.4;
  pointer-events: none;
}
.disable div,
.disable textarea {
  overflow: hidden;
}
.disable input{
    
}
</style>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h4>
                        <strong>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-left text-dark">
                                        Solicitud de venta de moto averiada o siniestrada
                                    </div>
                                    {{-- <div class="float-right">
                                        <a href="{{ url('motos-que-nos-ofrecen') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> <i
                                            class="pe-7s-back-2 btn-icon-wrapper"> </i>Volver</a>
                                    </div> --}}
                                </div>
                            </div>
                        </strong>
                    </h4>
                    {!! Form::open(['route' => 'motos-que-nos-ofrecen.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="card" id="moto">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de la moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-4 show">
                                        <div class="position-relative form-group">
                                            <label for="brand" class="">Marca:</label>
                                            <select class="form-control select" name="brand" id="brand" onChange="setModel()">
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
                                    <div class="col-md-4 show">
                                        <div class="position-relative form-group">
                                            <label for="model" class="">Modelo:</label>
                                            <select class="form-control select" name="model" id="model" disabled >
                                                <option value="" disabled selected="">Seleccione</option>
                                            </select>
                                            @if ($errors->has('model'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('model') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 hidden">
                                        <div class="position-relative form-group">
                                            <label for="brand" class="">Marca:</label>
                                            <input type="text" class="form-control" id="modelotxt" name="brand" placeholder="Escribe tu modelo" disabled>
                                            @if ($errors->has('brand'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('brand') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden">
                                        <div class="position-relative form-group">
                                            <label for="model" class="">Modelo:</label>
                                            <input type="text" class="form-control oculto" name="model" id="marcatxt" placeholder="Escribe tu marca" disabled>
                                            @if ($errors->has('model'))
                                                <span class="error text-danger">
                                                    <strong>{{ $errors->first('model') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button type="button" id="ver" class="btn btn-danger form-control pull-left">No encuentro Modelo/marca</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="exist_model_brand" id="exist_model_brand" value="1">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="year" class="">Año:</label>
                                            <select name="year" id="year" class="form-control" value="{{ old('year') }}" required></select>
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
                                <hr>
                                <div class="form-group">
                                    <button type="button" id="continuar" class="btn btn-primary pull-right">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card disable" id="contacto">
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
                                            <input name="phone" title="Ejemplo: +34620515223" pattern="^\+[1-9]{1}[0-9]{3,14}$" placeholder="Ejemplo: +34620515223" id="phone" type="text" class="form-control"
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
                                <hr>
                                <div class="form-group">
                                    <button type="button" id="volvermoto" class="btn btn-danger pull-left">Atras</button>
                                    <button type="button" id="tasacion" class="btn btn-primary pull-right">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="card disable" id="estado">
                            <h5 class="card-header text-white bg-secondary mb-3">Estado de la Moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="status_trafic" class="">Estado en tráfico: </label>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="high" name="status_trafic"
                                                    class="custom-control-input" value="Alta"  @if(old('status_trafic') && old('status_trafic') == 'Alta') checked @endif>
                                                <label class="custom-control-label" for="high">Alta</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="final_discharge" name="status_trafic"
                                                    class="custom-control-input" value="Baja definitiva"  @if(old('status_trafic') && old('status_trafic') == 'Baja') checked @endif>
                                                <label class="custom-control-label" for="final_discharge">Baja</label>
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
                                                <input type="radio" id="g_del" name="motocycle_state"
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('motocycle_state') && old('motocycle_state') == 'Golpe Delantero') checked @endif>
                                                <label class="custom-control-label" for="g_del">Golpe Delantero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="g_tras" name="motocycle_state"
                                                    class="custom-control-input" value="Golpe Trasero" 
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('motocycle_state') && old('motocycle_state') == 'Golpe Trasero') checked @endif>
                                                <label class="custom-control-label" for="g_tras">Golpe Trasero</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_elec" name="motocycle_state"
                                                    class="custom-control-input" value="Avería Eléctrica" 
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('motocycle_state') && old('motocycle_state') == 'Avería Eléctrica') checked @endif>
                                                <label class="custom-control-label" for="av_elec">Avería Eléctrica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="av_mec" name="motocycle_state"
                                                    class="custom-control-input" value="Avería Mecánica" 
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('motocycle_state') && old('motocycle_state') == 'Avería Mecánica') checked @endif>
                                                <label class="custom-control-label" for="av_mec">Avería Mecánica</label>
                                            </div>
                                            <div class="custom-radio custom-control custom-control-inline">
                                                <input type="radio" id="old" name="motocycle_state"
                                                    class="custom-control-input" value="Vieja o Abandonada" 
                                                    class="custom-control-input" value="Golpe Delantero" @if(old('motocycle_state') && old('motocycle_state') == 'Vieja o Abandonada') checked @endif>
                                                <label class="custom-control-label" for="old">Vieja o Abandonada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">Observaciones: </label>
                                            <textarea class="form-control" name="observations">{{ old('observations') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">¿Cual es el precio mínimo que aceptas?: </label>
                                            <input type="number" step="any" class="form-control" id="price_min" name="price_min" value="{{ old('price_min') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label class="btn btn-primary btn-file mt-4">
                                                Cargar Imagenes <span class="requerido" >*</span>
                                                <input type="file" id="imagenes" required name="images[]" style="display: none;" multiple accept='image/*' >
                                            </label>
                                            <span>Seleccione hasta 5 imagenes</span>  
                                        </div>
                                        <div class="position-relative form-group">
                                            <output id="lista">Debe Cargar 1 foto minimo</output>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="button" id="volverdatos" class="btn btn-danger pull-left">Atras</button>
                                    <button type="submit" id="tasacion" class="btn btn-primary pull-right finalizar">Finalizar</button>
                                </div>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let startYear = 1800;
        let endYear = new Date().getFullYear();
        for (i = endYear; i > startYear; i--)
        {
          $('#year').append($('<option />').val(i).html(i));
        }
    </script>

    <script>
        $(function(){
            $("#imagenes").on('change', function () {
                if(this.files.length>5){
                    alert('No pueden ser mas de 5 imagenes')
                    }
                else {
                    //Get count of selected files
                    var countFiles = $(this)[0].files.length;
                
                    var imgPath = $(this)[0].value;
                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                    var image_holder = $("#lista");
                    image_holder.empty();
                
                    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                        if (typeof (FileReader) != "undefined") {
                
                            //loop for each file selected for uploaded.
                            for (var i = 0; i < countFiles; i++) {
                
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $("<img />", {
                                        "src": e.target.result,
                                            "class": "rounded img-fluid mr-2 mb-2",
                                            "style": "height:200px;width:200px"
                                    }).appendTo(image_holder);
                                }
                
                                image_holder.show();
                                reader.readAsDataURL($(this)[0].files[i]);
                            }
                
                        }
                    } else {
                        alert("Por favor seleccione una imagen");
                    }
                }
            });
        });

        var $i = 1;
        $('#ver').click(function(){
            $('.hidden').toggle();
            $('.show').toggle();
            if ($i === 0) {
                $(this).html("No encuentro Modelo/marca");
                $('#marcatxt').removeAttr('required');
                $('#modelotxt').removeAttr('required');
                $('#marcatxt').attr('disabled', 'disabled');
                $('#modelotxt').attr('disabled', 'disabled');
                $('#brand_text').val('');
                $('#model_text').val('');
               
                $('#model').removeAttr('disabled');
                $('#brand').removeAttr('disabled');

                $('#exist_model_brand').val(1);
            
                $i = 1;
            } else {
                $(this).html("Elegir marca y modelo de la lista");
                $('#model').attr('disabled', 'disabled');
                $('#brand').attr('disabled', 'disabled');
                $('#marcatxt').removeAttr('disabled');
                $('#modelotxt').removeAttr('disabled');

                $('#marcatxt').attr('required', 'required');
                $('#modelotxt').attr('required', 'required');
                $('#marcatxt').val('');
                $('#modelotxt').val('');

                $('#exist_model_brand').val(0);

                $i = 0;
            }
        });

        //primer siguiente
        $('#continuar').click(function(e){
            e.preventDefault();
            var modelo=$('#model').val();
            var modelotxt=$('#modelotxt').val();
            if (modelo || modelotxt){
                $("#moto").addClass("disable");
                $("#contacto").removeClass("disable");
            }
            
        });
        //
        //volver a datos moto
        $('#volvermoto').click(function(){
            $("#moto").removeClass("disable");
            $("#contacto").addClass("disable");
        });
        //
        //sigue a tasacion
        $('#tasacion').click(function(e){
            e.preventDefault();
            var correo=$('#email').val();
            var nombre=$('#name').val();
            var telefono=$('#phone').val();
            var provincia=$('#province').val();
            if (correo && nombre && telefono && provincia){
                $("#contacto").addClass("disable");
                $("#estado").removeClass("disable");
            }
            
        });
        //
        //volver a datos contacto
        $('#volverdatos').click(function(){
            $("#contacto").removeClass("disable");
            $("#estado").addClass("disable");
        });
        //

    </script>

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
@endsection
