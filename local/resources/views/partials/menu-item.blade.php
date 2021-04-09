@if ($item['submenu'] == [])
    <li>
        <a href="{{ $item['slug'] }}">
            <i class="metismenu-icon fa fa-circle" style="font-size: .7rem;"></i>{{ $item['name'] }}
        </a>
    </li> 
@else
    <li>
        <a href="#" aria-expanded="false">
            <i class="metismenu-icon fa fa-circle" style="font-size: .7rem;"></i>
            {{ $item['name'] }}
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    <li>
                        <a href="{{ url($submenu['slug']) }}">{{ $submenu['name'] }} </a>
                    </li>
                @endif
            @endforeach                
        </ul>
    </li>
@endif