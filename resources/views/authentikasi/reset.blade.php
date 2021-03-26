@extends('templates.auth')

@section('title', 'eKopz | Reset Password')

@section('content')
  <div id="preloader">
      <div class="loader">
          <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
          </svg>
      </div>
  </div>
  <div class="login-bg h-100">
      <div class="container h-100">
          <div class="row justify-content-center h-100">
              <div class="col-xl-6">
                  <div class="form-input-content login-form">
                      <div class="card">
                          <div class="card-body">
                              <div class="logo text-center">
                                  <a href="index.html">
                                      <img src="{{ asset('assets/images/ekopz-icon.png') }}" style="width: 50px;" alt="">
                                  </a>
                              </div>
                              <h4 class="text-center mt-4">{{ __('Reset Password') }}</h4> <br>

                              @if (session('status'))
                                  <div class="alert alert-success" role="alert">
                                      {{ session('status') }}
                                  </div>
                              @endif

                              <form class="mt-5 mb-5" action="{{ route('password.update') }}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">

                                    @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="text-center mb-4 mt-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
