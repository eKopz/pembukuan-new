@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Pengurus</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Pengurus</li>
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
                            <h4 class="text-success section-heading card-intro-title">Data Pengurus</h4>
                            <div class="user-info">
                                <ul>
                                    <li>
                                        <h5>Nama Pengurus</h5>
                                        <p>{{ $pengurus->anggota->pengguna->user->name }}</p>
                                    </li>
                                    <li>
                                        <h5>Jabatan</h5>
                                        <p>{{ $pengurus->jabatan }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Jenis Kelamin</h5>
                                        <p>{{ $pengurus->anggota->pengguna->jenis_kelamin}}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Tanggal Lahir</h5>
                                        @if ($pengurus->anggota->pengguna->ttl == null)
                                            Tidak Diketahui
                                        @else
                                            <p>{{ $pengurus->anggota->pengguna->ttl }}</p>
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <h5>No Handphone</h5>
                                        <p>{{ $pengurus->anggota->pengguna->no_hp }}</p>
                                    </li>
                                    <li class="mb-4">
                                        <h5>Email</h5>
                                        <p>{{ $pengurus->anggota->pengguna->user->email }}</p>
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
                                        @if ($pengurus->anggota->pengguna->no_ktp == null)
                                            Tidak Diketahui
                                        @else
                                            <p>{{ $pengurus->anggota->pengguna->no_ktp }}</p>
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <h5>Foto KTP</h5>
                                        @if ($pengurus->anggota->pengguna->foto_ktp == null)
                                            Tidak Diketahui
                                        @else
                                            <img src="{{ $pengurus->anggota->pengguna->foto_ktp }}" alt="" width="200">
                                        @endif
                                    </li>
                                    <li class="mb-4">
                                        <a href="/pengurus" class="btn btn-success">Kembali</a>
                                    </li>
                                </ul>
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
                    <img class="rounded-circle" @if ($pengurus->anggota->pengguna->foto == null || $pengurus->anggota->pengguna->foto == "") src="{{ asset('assets/images/users/1.jpg') }}" @endif src="{{ $pengurus->anggota->pengguna->foto }}" alt="image">
                </div>
                <div class="user-intro">
                    <h4 class="text-primary card-intro-title mb-0">{{ $pengurus->anggota->pengguna->user->name }}</h4>
                    {{-- <p><small>@ Druid Wensleydale</small> --}}
                    </p>
                    <p>Pengurus</p>
                </div>
                <div class="contact-addresses">
                    <ul class="contact-address-list">
                        <li class="email">
                            <a href="/pengurus/edit/{{ $pengurus->id }}" class="btn btn-warning">Edit</a>
                            <a href="/pengurus/delete/{{ $pengurus->id }}" class="btn btn-danger">Hapus</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
