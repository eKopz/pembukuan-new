@extends('templates.index')

@section('title', 'ekopz | Anggota')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Anggota</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Anggota</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Anggota</li>
        </ol>
    </div>
@endsection


@section('content')
  <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="user-profile">
                            <h4 class="text-success section-heading card-intro-title">Detail Anggota</h4>
                            <div class="user-info">
                                <ul>
                                    <li class="mb-4">
                                        <h5>No Anggota</h5>
                                        <p>{{ $anggota->no_anggota }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Nama Anggota</h5>
                                        <p>{{ $anggota->nama }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Jenis Kelamin</h5>
                                        <p>{{ $anggota->pengguna->jenis_kelamin}}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Tanggal Lahir</h5>
                                        @if ($anggota->pengguna->ttl == null)
                                            Tidak Diketahui
                                        @else
                                            <p>{{ $anggota->pengguna->ttl }}</p>
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <h5>No Handphone</h5>
                                        <p>{{ $anggota->pengguna->no_hp }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Email</h5>
                                        <p>{{ $anggota->pengguna->user->email }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Alamat</h5>
                                        @if ($alamat == null)
                                            Tidak Diketahui
                                        @else 
                                            <p>Kota {{ $alamat['city_name'] }}, Provinsi {{ $alamat['province'] }} </p>
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <h5>No KTP</h5>
                                        @if ($anggota->pengguna->no_ktp == null)
                                            Tidak Diketahui
                                        @else
                                            <p>{{ $anggota->pengguna->no_ktp }}</p>
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <h5>Foto KTP</h5>
                                        @if ($anggota->pengguna->foto_ktp == null)
                                            Tidak Diketahui
                                        @else
                                            <img src="{{ $anggota->pengguna->foto_ktp }}" alt="" width="200">
                                        @endif
                                    </li>

                                    <li class="mb-4">
                                        <a href="/anggota" class="btn btn-success">Kembali</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="card widget-media-bordered">
                    <div class="card-body">
                        <div class="media py-3 align-items-center media-colored">
                            <img class="mr-3" src="../../assets/images/icons/57.png" alt="">
                            <div class="media-body">
                                <p class="text-pale-sky mb-1">Simpanan Manasuka</p>
                                <h2 class="text-success">Rp. {{ number_format($anggota->simpanan,0,',','.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card widget-media-bordered">
                    <div class="card-body">
                        <div class="media py-3 align-items-center media-colored">
                            <img class="mr-3" src="../../assets/images/icons/57.png" alt="">
                            <div class="media-body">
                                <p class="text-pale-sky mb-1">Simpanan Wajib</p>
                                <h2 class="text-success m-0">Rp. {{ number_format($anggota->simpanan_wajib,0,',','.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card widget-media-bordered">
                    <div class="card-body">
                        <div class="media py-3 align-items-center media-colored">
                            <img class="mr-3" src="../../assets/images/icons/57.png" alt="">
                            <div class="media-body">
                                <p class="text-pale-sky mb-1">Simpanan Pokok</p>
                                <h2 class="text-success m-0">Rp. {{ number_format($anggota->simpanan_pokok,0,',','.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card widget-media-bordered">
                    <div class="card-body">
                        <div class="media py-3 align-items-center media-colored">
                            <img class="mr-3" src="../../assets/images/icons/58.png" alt="">
                            <div class="media-body">
                                <p class="text-pale-sky mb-1">Pinjaman</p>
                                <h2 class="text-danger m-0">Rp. {{ number_format($anggota->pinjaman,0,',','.') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 my-5 my-lg-0">
        <div class="card card-full-width rounded-0">
            <div class="card-body user-details-contact text-center">
                <div class="user-details-image mb-3">
                    <img class="rounded-circle" @if ($anggota->pengguna->foto == null || $anggota->pengguna->foto == "") src="{{ asset('assets/images/users/1.jpg') }}" @endif src="{{ $anggota->pengguna->foto }}" alt="image">
                </div>
                <div class="user-intro">
                    <h4 class="text-primary card-intro-title mb-0">{{ $anggota->nama }}</h4>
                    </p>
                    @if ($anggota->status == 1)
                        <p>Anggota</p> 
                    @else
                        <p class="text-danger">Keluar</p> 
                    @endif
                </div>
                <div class="contact-addresses">
                    <ul class="contact-address-list">
                        <li class="email">
                            @if ($anggota->status == 1)
                                <a href="/anggota/edit/{{ $anggota->id }}" class="btn btn-warning">Edit</a>
                                <a href="/anggota/nonaktif/{{ $anggota->id }}" class="btn btn-danger">Nonaktif</a>
                            @else
                                
                            @endif
                            
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
