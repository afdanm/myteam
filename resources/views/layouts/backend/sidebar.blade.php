<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="/" target="_balnk"><img class="img-fluid for-light" src="/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="/assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="/" target="_balnk"><img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt=""></a></div>
            <nav class="sidebar-main">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href="/" target="_balnk"><img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        @php $x = 0 @endphp
                        <li class="sidebar-list">
                            <a id="{{ $x }}" class="sidebar-link sidebar-title {{ (request()->segment(1) == 'dashboard') ? 'active' : ''  }} link-nav" href="{{ route('dashboard') }}"><i data-feather="home"> </i><span>Dashboard</span></a>
                        </li>
                        @php $x++ @endphp
                        @foreach($menus as $menu)
                            <li class="sidebar-list">
                                <a id="{{ $x }}" class="sidebar-link sidebar-title @if(!ISSET($menu['child'])) link-nav @endif {{ ('/'.request()->segment(1) == $menu['href']) ? 'active' : '' }}" href="@if(isset($menu['href'])) {{ url($menu['href']) }} @else javascript:void(0) @endif"><i data-feather="{{ $menu['icon'] }}"> </i><span>{{ $menu['nama_menu'] }}</span></a>
                                @if(ISSET($menu['child']))
                                    @include('layouts.backend.sidebarMainChild',['menus'=>$menu['child'], 'flag_id'=>$x.'-'])
                                @endif
                            </li>
                            @php $x++ @endphp
                        @endforeach
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
</div>
<!-- Page Sidebar Ends-->