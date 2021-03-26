@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Edit Pengurus</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Edit Pengurus</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Pengurus</h4>
            <div class="basic-form">
                <form action="/pengurus/update/{{ $pengurus->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">Jabatan</label>
                      <select name="jabatan" class="js-example-placeholder-multiple form-control">
                        <option @if ($pengurus->jabatan == 'Ketua') selected @endif value="Ketua">Ketua</option>
                        <option @if ($pengurus->jabatan == 'Wakil Ketua') selected @endif value="Wakil Ketua">Wakil Ketua</option>
                        <option @if ($pengurus->jabatan == 'Sekretaris') selected @endif value="Sekretaris">Sekretaris</option>
                        <option @if ($pengurus->jabatan == 'Bendahara') selected @endif value="Bendahara 1">Bendahara</option>
                        <option @if ($pengurus->jabatan == 'Pengawas 1') selected @endif value="Pengawas 1">Pengawas 1</option>
                        <option @if ($pengurus->jabatan == 'Pengawas 2') selected @endif value="Pengawas 2">Pengawas 2</option>
                        <option @if ($pengurus->jabatan == 'Administrasi 1') selected @endif value="Administrasi 1">Administrasi 1</option>
                        <option @if ($pengurus->jabatan == 'Administrasi 2') selected @endif value="Administrasi 2">Administrasi 2</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 1') selected @endif value="Operator Toko 1">Operator Toko 1</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 2') selected @endif value="Operator Toko 2">Operator Toko 2</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 3') selected @endif value="Operator Toko 3">Operator Toko 3</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 4') selected @endif value="Operator Toko 4">Operator Toko 4</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 5') selected @endif value="Operator Toko 5">Operator Toko 5</option>
                        <option @if ($pengurus->jabatan == 'Operator Toko 6') selected @endif value="Operator Toko 6">Operator Toko 6</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Pengurus</label>
                      <select name="jabatan" class="js-example-placeholder-multiple form-control">
                        <option @if ($pengurus->status == 1) selected @endif value="1">Pengurus</option>
                        <option @if ($pengurus->status == 0) selected @endif value="0">Keluar</option>
                      </select>
                    </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/pengurus" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
