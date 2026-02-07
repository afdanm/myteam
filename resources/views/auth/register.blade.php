@extends('layouts.login.main', ['title' => 'Sign up | '.config('app.name')])

@section('container')
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light" src="{{ asset('/assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
              <div class="login-main">
                <form class="theme-form"method="POST" action="{{ route('register') }}">
                     @csrf
                    <h4>Create your account</h4>
                    <p>Enter your personal details to create account</p>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <input class="form-control @error('username') is-invalid @enderror" name="username" type="text" id="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">{{ __('Name') }}</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="info@esto.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label @error('password') is-invalid @enderror">{{ __('Password') }}</label>
                        <div class="form-input position-relative">
                            <input id="password" class="form-control password" type="password" name="password" required autocomplete="new-password" placeholder="*********">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                        <div class="form-input position-relative">
                            <input id="password-confirm" class="form-control password" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="*********">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="checkbox p-0">
                            <input id="checkbox1" type="checkbox">
                            <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                        </div>
                        <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Create Account') }}</button>
                    </div>
                    <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('login') }}">{{ __('Sign in') }}</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="/assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="/assets/js/script.js"></script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
@endsection
