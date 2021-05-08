@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data Pengurus</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Data Pengurus</li>
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
        <div class="row">
            <div class="col">
                <a href="/pengurus/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                    <i class="fa fa-plus color-info"></i> </span>Tambah Data Pengurus</a>

                <div class="card">
                    <h4 class="card-title ml-5 mt-5">Data Pengurus</h4>

                    <div class="doctor-list pt-4">
                        @foreach ($pengurus as $item)
                            <div class="media bg-white">
                                <img class="mr-3 rounded-circle" alt="image" width="50" @if (!$item->anggota->pengguna->foto || $item->anggota->pengguna->foto == null) src="{{ asset('assets/images/user/profile-user.svg') }}" @else src="{{ $item->anggota->pengguna->foto }}" @endif>
                                <div class="media-body">
                                    <h5 class="mt-2 text-pale-sky">{{ $item->anggota->nama }}</h5>
                                    <h6 class="text-success mb-0">{{ $item->jabatan }}</h6>
                                </div>
                                <a href="/pengurus/detail/{{ $item->id }}" class="btn btn-success">Detail</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <a href="/pengurus/karyawan/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                    <i class="fa fa-plus color-info"></i> </span>Tambah Data Karyawan</a>

                <div class="card">
                    <h4 class="card-title ml-5 mt-5">Data Karyawan Koperasi</h4>

                    <div class="doctor-list pt-4">
                        @foreach ($karyawan as $value)
                            <div class="media bg-white">
                                <img class="mr-3 rounded-circle" alt="image" width="50" @if (!$value->anggota->pengguna->foto || $value->anggota->pengguna->foto == null) src="{{ asset('assets/images/user/profile-user.svg') }}" @else src="{{ $value->anggota->pengguna->foto }}" @endif>
                                <div class="media-body">
                                    <h5 class="mt-2 text-pale-sky">{{ $value->anggota->nama }}</h5>
                                    <h6 class="text-success mb-0">{{ $value->loker }}</h6>
                                </div>
                                <a href="/pengurus/karyawan/detail/{{ $value->id }}" class="btn btn-success">Detail</a>
                            </div>
                        @endforeach
                    </div>
                </div>
    
                <div class="d-flex justify-content-center">
                    {{  $pengurus->links()  }}
                </div>
            </div>
        </div>
  </div>
@endsection
