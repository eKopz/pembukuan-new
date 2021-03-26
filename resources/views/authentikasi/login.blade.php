@extends('templates.auth')

@section('title', 'eKopz | Login')

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
                              <h4 class="text-center mt-4">Log into Your Account</h4> <br>

                              <?php if (Session::has('alert')): ?>
                                <div class="alert alert-danger">
                                  {{Session::get('alert')}}
                                </div>
                              <?php elseif (Session::has('alert-success')): ?>
                                <div class="alert alert-success">
                                  {{Session::get('alert-success')}}
                                </div>
                              <?php elseif (Session::has('registered-success')): ?>
                                <div class="alert alert-success">
                                  {{Session::get('registered-success')}}
                                </div>
                              <?php endif; ?>

                              <form class="mt-5 mb-5" action="/login/proses" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">

                                    @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input id="password" type="password" name="password" class="form-control" placeholder="Password">

                                    @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="form-check p-l-0">
                                            <input class="form-check-input" type="checkbox" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label ml-3" for="basic_checkbox_1">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 text-right"><a href="/resetpassword">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="text-center mb-4 mt-4">
                                    <button type="submit" class="btn btn-success">{{ __('Login') }}</button>
                                </div>
                              </form>
                              <div class="text-center">
                                  <h5 class="mb-5">Or with Login</h5>
                                  <ul class="list-inline">
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-facebook"><i class="fa fa-facebook"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-twitter"><i class="fa fa-twitter"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-google-plus"><i class="fa fa-google-plus"></i></a>
                                      </li>
                                  </ul>
                                  <p class="mt-5">Dont have an account? <a href="/register">Register Now</a>
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
