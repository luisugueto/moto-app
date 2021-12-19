
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Datos Guardados</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('assets/css/util.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/proximamente.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <meta name="robots" content="noindex, follow">
    </head>
    <body>
        <div class="bg-g2 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
            <span></span>
            <div class="flex-col-c p-t-50 p-b-50">
                <h3 class="l1-txt1 txt-center p-b-10">
                    Formulario registrado exitosamente. 
                </h3>
                <p class="txt-center l1-txt2 p-b-60">
                    Para dirigirse a motOstion darle click al siguiente enlace
                </p>
                <a class="flex-c-m s1-txt2 size3 how-btn" href="{{ url('https://motostion.com/')}}">MotOstion!</a>
                <p class="txt-center l1-txt2 p-t-50 p-b-40">
                    Ó dirigirse a la página principal de login
                </p>
                <a class="flex-c-m s1-txt2 size3 how-btn" href="{{ url('/login')}}">Gestion de MotOstion!</a>
            </div>
            <span class="s1-txt3 txt-center">
                Copyright © 2021 MOTOSTION. Todos los derechos reservados
            </span>
        </div>
        <!-- JS -->
        <script src="{{ asset('assets/scripts/base/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/base/popper.min.js') }}"></script>
        <script src="{{ asset('assets/scripts/base/bootstrap.min.js') }}"></script> 
    </body>
</html>

