@extends('layouts.login.main', ['title' => 'Forgot Password | '.config('app.name')])

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
        <div class="row">
          <div class="col-12">
            <div class="login-card">
              <div>
                <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light" src="{{ asset('/assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
                <div class="login-main">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="theme-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4>{{ __('Reset Password') }}</h4>
                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocusplaceholder="*********">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-end mt-3">
                            <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Send Reset Password') }}</button>
                        </div>
                        <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{ route('register') }}">{{ __('Create Account') }}</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- page-wrapper Ends-->
    <!-- latest jquery-->
    <script src="{{ asset('/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
@endsection
