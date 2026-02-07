@extends('layouts.login.main', ['title' => 'Sign in | '.config('app.name')])

@section('container')
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo" href="{{ route('home') }}"><img class="img-fluid for-light" src="{{ asset('/assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('/assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
              <div class="login-main">
                <form class="theme-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4>Sign in to account</h4>
                    <p>Enter your username or email & password to login</p>
                    <div class="form-group">
                        <label class="col-form-label">{{ __('Username OR Email Address') }}</label>
                        <input class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Your Account">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label @error('password') is-invalid @enderror">{{ __('Password') }}</label>
                        <div class="form-input position-relative">
                            <input class="form-control password" name="password" required autocomplete="current-password" type="password" placeholder="*********">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-0">
                        <div class="checkbox p-0">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="text-muted" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <div class="text-end mt-3">
                            <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Sign in') }}</button>
                        </div>
                    </div>
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ route('register') }}">{{ __('Create Account') }}</a></p>
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
