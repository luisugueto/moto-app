<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Tablero</li>
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="metismenu-icon pe-7s-rocket"></i>Inicio
        </a>
    </li>
    <li class="app-sidebar__heading">Funcionalidad</li>
    <li>
        <a href="{{ url('/mototion') }}">
            <i class="metismenu-icon pe-7s-network"></i>Mototion
        </a>
    </li> 
    <li>
        <a href="{{ url('/gestion_compra/create') }}">
            <i class="metismenu-icon pe-7s-note2"></i>Gestion de Compra
        </a>
    </li>     
    
    <li class="app-sidebar__heading">Configuracion</li>
    <li>
        <a href="{{ url('/users') }}">
            <i class="metismenu-icon pe-7s-add-user"></i>Usuarios
        </a>
    </li>
</ul>