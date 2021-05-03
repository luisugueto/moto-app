@extends('layouts.app')

@section('content')
<!-- Page Content-->
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-5">
            <h2>What We Do</h2>
            <hr />
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
            <a class="btn btn-primary btn-lg" href="#!">Call to Action »</a>
        </div>
        <div class="col-md-4 mb-5">
            <h2>Contact Us</h2>
            <hr />
            <address>
                <strong>Start Bootstrap</strong>
                <br />
                3481 Melrose Place
                <br />
                Beverly Hills, CA 90210
                <br />
            </address>
            <address>
                <abbr title="Phone">P:</abbr>
                (123) 456-7890
                <br />
                <abbr title="Email">E:</abbr>
                <a href="mailto:#">name@example.com</a>
            </address>
        </div>
    </div>
    <div class="row">
        @foreach ($purchases as $item)
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="embed-responsive embed-responsive-16by9">
                    <img class="card-img-top embed-responsive-item" src="local/public/img_app/images_purchase/{{ $item->imagen }}" alt="..." />
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $item->brand}}</h4>
                    <p class="card-text"><b>Modelo</b> {{$item->model}} <small><b>Km</b> {{ $item->km }}</small></p>
                </div>
                <div class="card-footer"><a class="btn btn-primary" href="{{ url('ver-moto/'. $item->id )}}">Ver más</a></div>
            </div>
        </div>  
        @endforeach      
    </div>
</div>
@endsection
