@extends('templates.index')

@section('title', 'ekopz | Karyawan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Update Karyawan</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Karyawan</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Update Karyawan</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Karyawan</h4>
            <div class="basic-form">
                <form action="/karyawan/add" method="post">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">Nama Perusahaan</label>
                      
                      <input type="text" name="karyawan" class="form-control">

                      @if($errors->has('karyawan'))
                          <div class="text-danger">
                            {{ $errors->first('karyawan') }}
                          </div>
                      @endif
                    </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/karyawan" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
