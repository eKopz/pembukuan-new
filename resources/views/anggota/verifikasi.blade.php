@extends('templates.index')

@section('title', 'ekopz | Anggota')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Verifikasi Anggota</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Anggota</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Verifikasi Anggota</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Verifikasi Anggota</h4>
            <div class="basic-form">
                <form action="/anggota/verifikasi/{{ $anggota->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">No anggota</label>
                      <input type="text" name="no_anggota" class="form-control" value="{{ $anggota->no_anggota }}" readonly>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" value="{{ $anggota->nama }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" @if ($pengguna->jenis_kelamin == 1) value="Laki-Laki" @elseif ($pengguna->jenis_kelamin == 2) value="Perempuan" @else value="" @endif readonly>
                    </div>

                    <div class="form-group">
                        <label class="text-label">No KTP</label>
                        <input type="text" name="noktp" class="form-control" value="{{ $pengguna->noktp }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Karyawan</label>
                        <input type="text" name="karyawan" class="form-control" value="{{ $anggota->karyawan->karyawan }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Verifikasi Anggota</label>
                        <select name="verifikasi" class="form-control">
                            <option value="1">setuju</option>
                            <option value="2">tolak</option>
                        </select>
                    </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/anggota" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
