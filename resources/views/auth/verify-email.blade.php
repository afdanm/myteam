@extends('layouts.login.main', ['title' => 'Verifiy Email | '.config('app.name')])

@section('container')
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
        <defs></defs>
        <filter id="goo">
            <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
            <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
        <!-- Unlock page start-->
        <div class="authentication-main mt-0">
            <div class="row">
            <div class="col-12">
                <div class="login-card">
                <div>
                    <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light" src="{{ asset('/assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <h4 class="text-center">{{ __('Verify Your Email Address') }}</h4>
                            <div class="form-group mb-0">
                                <p class="text-center">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }},
                                </p>
                                <button type="submit" class="btn btn-primary btn-block w-100">{{ __('click here to request another') }}</button>.
                            </div>
                            <p class="mt-0 mb-0 text-center">You want to check another account ?<a class="ms-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a></p>
                        </form>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Unlock page end-->
        <!-- page-wrapper Ends-->
        <!-- latest jquery-->
        <script src="../assets/js/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap js-->
        <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="../assets/js/config.js"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="../assets/js/script.js"></script>
        <!-- login js-->
        <!-- Plugin used-->
        </div>
    </div>
@endsection
