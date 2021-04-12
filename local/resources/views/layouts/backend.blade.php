<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Panel Administrativo MotOstion.</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Web MotOstion.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{ asset('assets/web_component/datatables.net-bs4/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/web_component/datatables.net-bs4/responsive/responsive.bootstrap4.min.css') }}" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- JS -->
    <script src="{{ asset('assets/scripts/base/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/popper.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/base/bootstrap.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    {{-- <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul> --}}
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            @if (isset(Auth::user()->image))
                                                <img width="42" height="42" class="rounded-circle" src="{{ url('local/public/img_app/profile_images/'.Auth::user()->image) }}" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            @else
                                                <img width="42" height="42" class="rounded-circle"
                                                src="{{ asset('assets/images/avatars/1.jpg') }}" alt="" />
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            @endif
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2"
                                                        style="background-image: url({{ asset('assets/images/dropdown-header/city3.jpg') }});">
                                                    </div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left mr-3">
                                                                    @if (isset(Auth::user()->image))
                                                                    <img width="42" height="42" class="rounded-circle" src="{{ url('local/public/img_app/profile_images/'.Auth::user()->image) }}" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}">
                                                                    @else
                                                                    <img width="42" height="42" class="rounded-circle"
                                                                        src="{{ asset('assets/images/avatars/1.jpg') }}"
                                                                        alt="" />
                                                                        @endif

                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">
                                                                        {{ Auth::user()->name }}</div>
                                                                    <div class="widget-subheading opacity-8">
                                                                        {{ Auth::user()->email }}</div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <a href="{{ url('/logout') }}"
                                                                        class="btn-pill btn-shadow btn-shine btn btn-focus"><i
                                                                            class="fa fa-btn fa-sign-out"></i>
                                                                        Cerrar Sesión</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Mi cuenta</li>
                                                        <li class="nav-item">
                                                            <a href="{{ route('profile', Auth::user()->id )}}" class="nav-link">Perfil</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left ml-3 header-user-info">
                                    <div class="widget-heading">{{ Auth::user()->name }}</div>
                                    <div class="widget-subheading">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow bg-dark sidebar-text-light">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        @include('partials.sidebar', ['menus' => $menus])                        
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                <div class="app-wrapper-footer">
                    @include('partials.footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Web Components -->
    <script src="{{ asset('assets/web_component/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/web_component/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/web_component/datatables.net-bs4/responsive/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/web_component/datatables.net-bs4/responsive/responsive.bootstrap4.js') }}">
    <script src="{{ asset('assets/web_component/datatables.net/dataTables.fixedHeader.min.js') }}"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
    <script src="{{ asset('assets/scripts/base/sweetalert2@10.js') }}"></script>
        
    <script src="{{ asset('assets/scripts/page.js') }}"></script>
    
</body>

</html>

@yield('modals')