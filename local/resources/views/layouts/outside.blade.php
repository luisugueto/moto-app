<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MotOstion.</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Web Mototion.">
    <meta name="msapplication-tap-highlight" content="no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- JS -->
    <script src="{{ asset('assets/scripts/base/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/popper.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/bootstrap.min.js') }}"></script> 
      

    <!-- remove this if you use Modernizr -->
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            {{-- <div class="bg-sunny-morning"> --}}
            <div class="bg-heavy-rain">
                <div class="d-flex">
                    <div class="mx-auto col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="container">                            
                            @yield('content')
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © MotOstion 2019</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/scripts/functions.js') }}"></script> 
    <script src="{{ asset('assets/scripts/jquery.custom-file-input.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $("select").select2();
        });
    </script>
    

    <script src="{{ asset('assets/scripts/base/sweetalert2@10.js') }}"></script>
        
    <script src="{{ asset('assets/scripts/page.js') }}"></script>
    
</body>

</html>
