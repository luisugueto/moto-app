@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Image -->
        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-body  h-100">
                    <a href="javascript:;" class="show-images" id="{{ $purchase->id }}">
                        <img class="img-fluid" src="../local/public/img_app/images_purchase/{{ $images_purchase->name }}"   />
                        <p class="text-center">Zoom</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Add to cart -->
        <div class="col-12 col-lg-6 add_to_cart_block">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <p class="price">{{ $precio }} $</p>
                    <p class="price_discounted"> {{ $purchase->price_min}} $</p>
                    <form method="get" action="cart.html">
                        <div class="form-group">
                            <p class="lead"><b>Modelo</b> {{$purchase->model}}</p>
                            <p class="lead"><b>Año</b> {{$purchase->year}}</p>
                            <p class="lead"><b>Km</b> {{$purchase->km}}</p>
                        </div>
                        <div class="form-group">
                            <label>Quantity :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control"  id="quantity" name="quantity" min="1" max="100" value="1">
                                <div class="input-group-append">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a href="cart.html" class="btn btn-success btn-lg btn-block text-uppercase">
                            <i class="fa fa-shopping-cart"></i> Add To Cart
                        </a>
                    </form>
                    <div class="product_rassurance">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-truck fa-2x"></i><br/>Fast delivery</li>
                            <li class="list-inline-item"><i class="fa fa-credit-card fa-2x"></i><br/>Secure payment</li>
                            <li class="list-inline-item"><i class="fa fa-phone fa-2x"></i><br/>+33 1 22 54 65 60</li>
                        </ul>
                    </div>
                    <div class="datasheet p-3 mb-2 bg-info text-white">
                        <a href="" class="text-white"><i class="fa fa-file-text"></i> Download DataSheet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Description -->
        <div class="col-12">
            <div class="card border-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-align-justify"></i> Description</div>
                <div class="card-body">
                    <p class="card-text"><b>Estado en trafico</b> {{ $purchase->status_trafic }}</p>     
                    <p class="card-text"><b>Estado de la moto</b>
                        @if ($purchase->g_del == 1)
                            Golpe delantero
                        @endif
                        @if ($purchase->g_tras  == 1)
                            Golpe Trasero
                        @endif
                        @if ($purchase->av_elec  == 1)
                            Avería Eléctrica
                        @endif
                        @if ($purchase->av_mec  == 1)
                            Avería Mecánica
                        @endif
                        @if ($purchase->old  == 1)
                            Vieja o Abandonada
                        @endif
                    </p>   
                    <p class="card-text"><b>Observaciones</b> <br>{{ $purchase->observations}}</p>  
                    <br>                 
                    <p class="card-text"><b>Nombre Contacto</b>  {{ $purchase->name}} {{ $purchase->lastname }}</p>   
                    <p class="card-text"><b>Télefono Contacto</b> {{ $purchase->phone}}</p>   
                    <p class="card-text"><b>Ubicación Contacto</b> {{ $purchase->province}}</p>   
                    <p class="card-text"><b>Email Contacto</b> {{ $purchase->email}}</p>   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal image -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{ $purchase->brand }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/js/view_moto.js') }}"></script>
@endsection