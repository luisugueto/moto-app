<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MotOstion</title>
    
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/')}}">MotOstion</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/')}}">Inicio</a>
                        </li>
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="#">Acerca</a>
                        </li>
                        <li class="nav-item {{ request()->is('motos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('motos') }}">Motos <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{ request()->is('cart') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('cart') }}">Carrito</a>
                        </li>                        
                        <li class="nav-item {{ request()->is('contacto') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('contacto') }}">Contacto</a>
                        </li>
                    </ul>
        
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-secondary btn-number">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        @if (Auth::guest())
                            <a class="btn btn-primary btn-sm ml-3" href="{{ url('/login') }}">
                                Ingresar
                            </a>
                            <a class="btn btn-success btn-sm ml-3" href="{{ url('/register') }}">
                                Registrarse
                            </a>                      
                        @else
                            
                                <a class="nav-link" href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                          
                                <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>
                                    Salir</a>
                            
                            <a class="btn btn-success btn-sm ml-3" href="{{ url('cart') }}">
                                <i class="fa fa-shopping-cart"></i> Carrito
                                <span class="badge badge-light">3</span>
                            </a>
                        @endif
                        
                    </form>
                </div>
            </div>
        </nav>
        <header class="bg-primary py-5 mb-5">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-12">
                        <h1 class="display-4 text-white mt-5 mb-2">MOTOSTION</h1>
                        <p class="lead mb-5 text-white-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non possimus ab labore provident mollitia. Id assumenda voluptate earum corporis facere quibusdam quisquam iste ipsa cumque unde nisi, totam quas ipsam.</p>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
        
        <!-- Footer -->
        <footer class="mt-5 py-5 text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-4 col-xl-3">
                        <h5>About</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <p class="mb-0">
                            Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.
                        </p>
                    </div>
        
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                        <h5>Informations</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Link 1</a></li>
                            <li><a href="">Link 2</a></li>
                            <li><a href="">Link 3</a></li>
                            <li><a href="">Link 4</a></li>
                        </ul>
                    </div>
        
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                        <h5>Others links</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><a href="">Link 1</a></li>
                            <li><a href="">Link 2</a></li>
                            <li><a href="">Link 3</a></li>
                            <li><a href="">Link 4</a></li>
                        </ul>
                    </div>
        
                    <div class="col-md-4 col-lg-3 col-xl-3">
                        <h5>Contact</h5>
                        <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-home mr-2"></i> My company</li>
                            <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                            <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                            <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                        </ul>
                    </div>
                    <div class="col-12 copyright mt-3">
                        <p class="float-left">
                            <a href="#">Back to top</a>
                        </p>
                        <p class="text-right text-muted">created with <i class="fa fa-heart"></i> by <a href="https://t-php.fr/43-theme-ecommerce-bootstrap-4.html"><i>t-php</i></a> | <span>v. 1.0</span></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('assets/scripts/base/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/base/popper.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/bootstrap.min.js') }}"></script>  
    </body>
</html>

