@extends('templates.auth')

@section('title', 'eKopz | Email Verification')

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
                    <div class="form-input-content">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <a href="https://ekopz.id/">
                                        <img src="{{ asset('assets/images/ekopz-icon.png') }}" style="width: 50px;" alt="">
                                    </a>
                                </div>
                                <h4 class="text-center mt-5">Email Verification</h4>
                                <p class="text-center">Kami telah mengirimkan email verifikasi ke {{ $email }}. Silakan cek email tersebut                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
