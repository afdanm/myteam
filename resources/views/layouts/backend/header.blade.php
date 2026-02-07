<!-- Page Header Start-->
<div class="page-header">
<div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
    <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
        <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
        </div>
        <div class="Typeahead-menu"></div>
        </div>
    </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo.png') }}" alt=""></a></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
        <h3>{{ $sub_title }}</h3>
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
    <ul class="nav-menus">
        {{-- <li class="language-nav">
            <div class="translate_wrapper">
                <div class="current_lang">
                <div class="lang"><i class="flag-icon flag-icon-id"></i><span class="lang-txt">ID</span></div>
                </div>
                <div class="more_lang">
                    <div class="lang selected" data-value="id"><i class="flag-icon flag-icon-id"></i><span class="lang-txt">Indonesia<span> (ID)</span></span></div>
                    <div class="lang" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                </div>
            </div>
        </li> --}}
        <li><span class="header-search"><i data-feather="search"></i></span></li>
        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="profile-nav onhover-dropdown p-0 me-0">
            <div class="media profile-media">
                <img class="b-r-10" height="37" src="@if(filter_var(auth()->user()->foto, FILTER_VALIDATE_URL)) {{ auth()->user()->foto }} @else {{ asset('/assets/images/foto/'.auth()->user()->foto) }} @endif" alt="">
                <div class="media-body"><span>{{ auth()->user()->name }}</span>
                <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
                <li><a href="#" target="_blank"><i data-feather="user"></i><span>Account </span></a></li>
                <li><a href="#" target="_blank"><i data-feather="settings"></i><span>Settings</span></a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"> </i><span>{{ __('Log out') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
    <div class="ProfileCard u-cf">
    <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
    <div class="ProfileCard-details">
    <!-- <div class="ProfileCard-realName">{/{name}}</div> -->
    <div class="ProfileCard-realName">NAME</div>
    </div>
    </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
</div>
</div>
<!-- Page Header Ends-->
