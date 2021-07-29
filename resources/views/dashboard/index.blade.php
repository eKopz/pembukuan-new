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
    <div class="col-12 mt-0">
          <div class="card-content">
            <?php if (session('status')): ?>
              <div class="alert alert-success alert-dismissible fade show">
                  <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                          aria-hidden="true">&times;</span>
                  </button> {{ session('status') }}
              </div>
            <?php endif; ?>
          </div>
          <div class="row">
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-1 rounded">
                        <div class="text">
                            <h2>{{ $anggota_aktif }}</h2>
                            <p>Total Anggota Aktif</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-5 rounded" style="background-color: red">
                        <div class="text">
                            <h2>{{ $anggota_nonaktif }}</h2>
                            <p>Total Anggota Keluar</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-5 rounded" style="background-color: red">
                        <div class="text">
                            <h2>{{ $pengajuan_pinjaman }}</h2>
                            <p>Total Pengajuan Pinjaman</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-2 rounded">
                        <div class="text">
                            <h2>Rp. {{ number_format($pinjaman_tersalur,0,',','.') }}</h2>
                            <p>Total Pinjaman Tersalur</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-exchange"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-1 rounded">
                        <div class="text">
                            <h2>Rp. {{ number_format($pinjaman_terbayar,0,',','.') }}</h2>
                            <p>Total Pinjaman Terbayar</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-4 rounded">
                        <div class="text">
                            <h2>{{ $total_produk }}</h2>
                            <p>Total Produk</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-cubes"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-3 rounded">
                        <div class="text">
                            <h2>{{ $produk_terjual }}</h2>
                            <p>Total Produk Terjual</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-cart-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body widget-school-stat bg-6 rounded">
                        <div class="text">
                            <h2>Rp. {{ number_format($total_penjualan,0,',','.') }}</h2>
                            <p>Total Penjualan</p>
                        </div>
                        <div class="icon">
                            <span><i class="fa fa-shopping-bag"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection