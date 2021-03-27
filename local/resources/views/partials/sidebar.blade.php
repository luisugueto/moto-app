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
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>

        <ul>
            <li>
                <a href="{{ url('/purchase_valuation_interested') }}">
                    <i class="metismenu-icon"></i>
                    Interesan
                </a>
            </li>
            <li>
                <a href="{{ url('purchase_valuation_no_interested') }}">
                    <i class="metismenu-icon"></i>
                    No Interesan
                </a>
            </li>
            
        </ul>
    </li> 
    <li>
        <a href="{{ url('/purchase_management') }}">
            <i class="metismenu-icon pe-7s-note2"></i>Gestion de Compra
        </a>
    </li>     
    
    <li class="app-sidebar__heading">Configuracion</li>
    <li>
        <a href="{{ url('/emails') }}">
            <i class="metismenu-icon pe-7s-mail"></i>Correos
        </a>
    </li>  
    <li>
        <a href="{{ url('/users') }}">
            <i class="metismenu-icon pe-7s-users"></i>Usuarios
        </a>
    </li>
    <li>
        <a href="{{ url('/roles') }}">
            <i class="metismenu-icon pe-7s-key"></i>Roles
        </a>
    </li>
    <li>
        <a href="{{ url('/states') }}">
            <i class="metismenu-icon pe-7s-flag"></i>Estados
        </a>
    </li>
    <li>
        <a href="{{ url('/processes') }}">
            <i class="metismenu-icon pe-7s-graph3"></i>Procesos
        </a>
    </li>
</ul>