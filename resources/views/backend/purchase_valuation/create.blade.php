@extends('layouts.backend')

@section('content')
<style>
    .hidden{
  display:none;
}
</style>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-speaker icon-gradient bg-night-fade">
                    </i>
                </div>
                <div>Tasación Motos
                    <div class="page-title-subheading">Ingrese los detalles del formulario para registrar la información
                        solicitada.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ url('purchase_valuation') }}" class="mb-2 mr-2 btn-icon btn-pill btn btn-primary"> <i
                            class="pe-7s-back-2 btn-icon-wrapper"> </i>Volver</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h4>
                        <strong>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-left">
                                        Solicitud de venta de moto averiada o siniestrada
                                    </div>
                                    <div class="float-right">
                                       
                                    </div>
                                </div>
                            </div>
                        </strong>
                    </h4>
                    <form class="" role="form" method="POST" action="{{ route('purchase_valuation.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="divider"></div>
                        <div class="card ">
                            <h5 class="card-header text-white bg-secondary mb-3">Datos de la moto</h5>
                            <div class="card-body">
                                <div class="form-row row g-1">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group">
                                            <label for="brand" class="">Marca:</label>
                                            <select class="form-control" name="brand" id="brand" >
                                                <option value="" disabled selected="">Seleccione</option>
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
                                            <select class="form-control" name="model" id="model" >
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
                                                <input type="radio" id="final_discharge" name="status_trafic"
                                                    class="custom-control-input" value="Baja definitiva">
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
                                            <textarea class="form-control" name="observations"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="status_vehicle" class="">¿Cual es el precio mínimo que aceptas?: </label>
                                            <input type="number" step="any" class="form-control" id="price_min" name="price_min" required>
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
                            </div>
                        </div>
                        <button type='submit' class="mt-2 btn btn-primary btn-lg">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                                            "class": "thumb"
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
    </script>

    <script>
        var setModel = () => {
        let id = $("#brand").val();
        $.ajax({
            url: '{{ url("getBrand") }}',
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            data: {
                id:id
            },
            type: 'POST',
            datatype: 'JSON',
            success: function (resp) {
                let select = $("#model").empty().append("<option disabled='disabled' selected>Seleccione</option>");
                
                $("#model").empty();
                
                resp.model.forEach(function(model, index){

                    select.append($('<option>', {
                        value: model.id,
                        text: model.name
                    }));
                });

            }
        });
    };
    </script>
@endsection
