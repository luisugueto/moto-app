@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase">Primera Moto</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="bloc_left_price">99.00 $</p>
                </div>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Última Moto</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="bloc_left_price">99.00 $</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                @foreach ($purchases as $item)
                <?php
                $fieldsArray = (json_decode(utf8_encode($item->data_serialize)));
                foreach ($fieldsArray as $key => $value) {
                    
                    if ($value->name == 'dLQrpaV2'){
                        $precio = $value->value;
                    }
                }
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="embed-responsive embed-responsive-16by9">
                            <img class="card-img-top embed-responsive-item" src="local/public/img_app/images_purchase/{{ $item->imagen }}" alt="..." />
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><a href="#" title="View Product">{{ $item->brand}}</a></h4>
                            <p class="card-text"><b>Modelo</b> {{$item->model}} /
                                <small><b>Km</b> {{ $item->km }}</small> /
                                <small><b>Año</b> {{$item->year}}</small> 
                            </p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">{{ $precio}} $</p>
                                </div>
                                <div class="col">
                                    <a href="{{ url('ver-moto/'. $item->id )}}" class="btn btn-success btn-block">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    {{ $purchases->render() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection