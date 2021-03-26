@extends('templates.index')

@section('title', 'ekopz | Dashboard')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Dashboard</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a>
            </li>
            <li class="breadcrumb-item active text-success">Dashboard</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="card">
        <div class="mt-5 mb-4 ml-5">
            <h3>Dasboard</h3>
        </div>
        <div class="row">
            <div class="col-sm-3 ml-5">
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Pengajuan Pinjaman</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $pengajuan_pinjaman }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Pinjaman Tersalur</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $pinjaman_tersalur }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Pinjaman Terbayar</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $pinjaman_terbayar }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ml-5">
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Produk</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $total_produk }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Produk Terjual</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $produk_terjual }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Penjualan</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $total_penjualan }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection