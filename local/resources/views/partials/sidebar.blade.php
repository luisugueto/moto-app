<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Tablero</li>
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="metismenu-icon pe-7s-rocket"></i>Inicio
        </a>
    </li>
    <li class="app-sidebar__heading">Funcionalidad</li>
    @foreach ($menus as $key => $item)
        @if ($item['parent'] != 0)
            @break
        @endif
        @include('partials.menu-item', ['item' => $item])
    @endforeach
</ul>