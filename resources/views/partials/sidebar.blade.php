<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Tablero</li>
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="metismenu-icon pe-7s-rocket"></i>Inicio
        </a>
    </li>
    <li class="app-sidebar__heading">Funcionalidad</li>
    <li>
        <a href="{{ url('/purchase_valuation') }}">
            <i class="metismenu-icon pe-7s-network"></i>Tasación Motos
        </a>
    </li> 
    <li>
        <a href="{{ url('/purchase_management') }}">
            <i class="metismenu-icon pe-7s-note2"></i>Gestion de Compra
        </a>
    </li>     
    
    <li class="app-sidebar__heading">Configuracion</li>
    <li>
        <a href="{{ url('/users') }}">
            <i class="metismenu-icon pe-7s-users"></i>Usuarios
        </a>
    </li>
    <li>
        <a href="{{ url('/user_types') }}">
            <i class="metismenu-icon pe-7s-key"></i>Roles
        </a>
    </li>
</ul>