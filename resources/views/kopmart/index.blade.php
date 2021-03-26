@extends('templates.index')

@section('title', 'ekopz | KopMart')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data KopMart</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">KopMart</a>
            </li>
            <li class="breadcrumb-item active text-success">Data KopMart</li>
        </ol>
    </div>
@endsection


@section('content')
  <div class="col-12 mt-0">
        <div class="card-content">
            <?php if (session('alert-success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> {{ session('alert-success') }}
            </div>
            <?php endif; ?>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="/kopmart/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>
                @if ($jumlah_toko == 0)
                    <p class="text-center">Tidak Ada Data</p>
                @endif
                <div class="row">
                    @foreach ($toko as $item)
                        <div class="col-sm-6">
                            <div class="card mb-4 pb-1 single-administrator">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="user-img mr-4">
                                            {{-- <span class="activity active"></span> --}}
                                            <img src="../../assets/images/user/2.png" height="50" width="50" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ $item->nama }}</h4>
                                            <p>{{ $item->alamat }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="/kopmart/produk/{{ $item->id }}" class="btn btn-success btn-sm btn-block">Data Produk</a>
                                        <a href="/kopmart/kategori/{{ $item->id }}" class="btn btn-success btn-sm btn-block">Kategori</a>
                                        <a href="/kopmart/penjualan/{{ $item->id }}" class="btn btn-success btn-sm btn-block">Data Penjualan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
  </div>
@endsection