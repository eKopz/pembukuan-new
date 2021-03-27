@extends('templates.index')

@section('title', 'ekopz | Anggota')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Anggota</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Anggota</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Anggota</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Anggota</h4>
            <div class="basic-form">
                <form action="/anggota/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">No anggota</label>
                      <input type="text" name="no_anggota" class="form-control">

                      @if($errors->has('no_anggota'))
                          <div class="text-danger">
                            {{ $errors->first('no_anggota') }}
                          </div>
                      @endif
                    </div>

                    {{-- <div class="form-group">
                        <label class="text-label">Pengguna</label>
                        <select name="pengguna" class="js-example-placeholder-multiple form-control">
                          @foreach ($pengguna as $item)
                            <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                          @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                      <label class="text-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control">

                      @if($errors->has('nama'))
                          <div class="text-danger">
                            {{ $errors->first('nama') }}
                          </div>
                      @endif
                    </div>

                    <div class="form-group">
                      <label class="text-label">Karyawan</label>
                      <select name="karyawan" class="js-example-placeholder-multiple form-control">
                        @foreach ($karyawan as $item)
                          <option value="{{ $item->id }}">{{ $item->karyawan }}</option>
                        @endforeach
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
