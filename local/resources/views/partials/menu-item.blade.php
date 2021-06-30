@if ($item['submenu'] == [])
    @if (getPermission($item['name'], 'record-view'))
    <li>
        <a href="{{ $item['slug'] }}">
            <i class="metismenu-icon fa fa-circle" style="font-size: .7rem;"></i>{{ $item['name'] }}
        </a>
    </li> 
    @endif
   
@else 
    @if (getPermission($item['name'], 'record-view')) 
    <li class="{{ request()->is($item['slug']) ? 'mm-active' : '' }}">
        <a href="#" aria-expanded="false">
            <i class="metismenu-icon fa fa-circle" style="font-size: .7rem;"></i>
            {{ $item['name'] }}
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul class="{{ request()->is($item['slug']) ? 'mm-show' : '' }}">
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    {{-- @if ($submenu['slug'] == 'estados-gc')
                    <li class="{{ request()->is($submenu['slug']) ? 'mm-active' : '' }}">
                        <a href="#" aria-expanded="false">
                            <i class="metismenu-icon"></i>  {{ $submenu['name'] }}
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul class="{{ request()->is($submenu['slug']) ? 'mm-show' : '' }}">
                            <li class="{{ request()->is($submenu['slug']) ? 'mm-active' : '' }}">
                                <a class="{{ request()->is($submenu['slug']) ? 'mm-active' : '' }}" href="{{url($submenu['slug'])}}">{{$submenu['name']}}
                                    <i class="metismenu-icon"></i>
                                </a>
                            </li>
                            <li class="{{ request()->is('purchase_valuation_interested') ? 'mm-active' : '' }}" >
                                <a  class="{{ request()->is('purchase_valuation_interested') ? 'mm-active' : '' }}" href="{{ url('/purchase_valuation_interested') }}">
                                    <i class="metismenu-icon"></i>Interesan
                                </a>
                            </li>
                            <li class="{{ request()->is('purchase_valuation_no_interested') ? 'mm-active' : '' }}" >
                                <a  class="{{ request()->is('purchase_valuation_no_interested') ? 'mm-active' : '' }}" href="{{ url('purchase_valuation_no_interested') }}">
                                    <i class="metismenu-icon"></i>No Interesan
                                </a>
                            </li>
                        </ul>
                    </li>   
                    @else --}}
                    
                    
                    @if (getPermission($submenu['name'], 'record-view')) 
                        <li class="{{ request()->is($submenu['slug']) ? 'mm-active' : '' }}">
                            <a class="{{ request()->is($submenu['slug']) ? 'mm-active' : '' }}" href="{{ url($submenu['slug']) }}">{{ $submenu['name'] }} </a>
                        </li>
                    @endif


                    {{-- @endif --}}
                @endif
            @endforeach                
        </ul>
    </li>
    @endif
@endif