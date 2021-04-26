<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MotOstion</title>
    
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo-inverse.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Inicio
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                        @if (Auth::guest())
                            <li class="nav-item">
                                <a class="btn btn-primary mr-1" href="{{ url('/login') }}">Ingresar</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-info" href="{{ url('/register') }}">Registrarse</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>
                                    Salir</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <header class="bg-primary py-5 mb-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h1 class="display-4 text-white mt-5 mb-2">MotOstion</h1>
                        <p class="lead mb-5 text-white-50">
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
                        </p>
                    </div>
                </div>
            </div>
        </header>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 mb-5">
                    <h2>What We Do</h2>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
                    <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
                </div>
                <div class="col-md-4 mb-5">
                    <h2>Contact Us</h2>
                    <hr>
                    <address>
                        <strong>Start Bootstrap</strong>
                        <br>3481 Melrose Place
                        <br>Beverly Hills, CA 90210
                        <br>
                    </address>
                    <address>
                        <abbr title="Phone">P:</abbr>
                        (123) 456-7890
                        <br>
                        <abbr title="Email">E:</abbr>
                        <a href="mailto:#">name@example.com</a>
                    </address>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary">Find Out More!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary">Find Out More!</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card">
                        <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary">Find Out More!</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
            </div>
            <!-- /.container -->
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('assets/scripts/base/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/base/popper.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/bootstrap.min.js') }}"></script>  
    </body>
</html>

