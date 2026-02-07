<ul class="nav-sub-childmenu submenu-content">
    @php $x = 0 @endphp
    @foreach($menus as $menu)
        <li><a id="{{ $flag_id.$x }}" class="@if(ISSET($menu['child'])) submenu-title @endif @if(ISSET($menu['href'])) {{ ('/'.request()->segment(1) == $menu['href']) ? 'active' : '' }}" @endif href="@if(isset($menu['href'])) {{ url($menu['href']) }} @else javascript:void(0) @endif">@if(ISSET($menu['nama_menu'])) {{ $menu['nama_menu'] }} @endif</a>
            @if(ISSET($menu['child']))
                @include('layouts.backend.sidebarChild',['menus'=>$menu['child'], 'flag_id'=>$flag_id.$x.'-'])
            @endif
        </li>
        @php $x++ @endphp
    @endforeach
</ul>