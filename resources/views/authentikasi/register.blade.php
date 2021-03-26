@extends('templates.auth')

@section('title', 'eKopz | Register')

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
                              <h4 class="text-center mt-4">Register Your Account Koperasi</h4> <br>

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

                              <form class="mt-5 mb-5" action="/register/proses" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>{{ __('Nama Koperasi') }}</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nama Koperasi">

                                    @error('name')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">

                                    @error('email')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input id="password" type="password" name="password" class="form-control" placeholder="Password">

                                    @error('password')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Repeat Password') }}</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password">

                                    @error('password_confirmation')
                                      <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="text-center mb-4 mt-4">
                                    <button type="submit" class="btn btn-success">{{ __('Register') }}</button>
                                </div>
                              </form>
                              <div class="text-center">
                                  {{-- <h5 class="mb-5">Or with Login</h5>
                                  <ul class="list-inline">
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-facebook"><i class="fa fa-facebook"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-twitter"><i class="fa fa-twitter"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                      </li>
                                      <li class="list-inline-item m-t-10"><a href="javascript:void()" class="btn btn-google-plus"><i class="fa fa-google-plus"></i></a>
                                      </li>
                                  </ul> --}}
                                  <p class="mt-5">Already have an account? <a href="/login">Login Now</a>
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
