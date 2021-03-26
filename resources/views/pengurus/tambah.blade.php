@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Pengurus</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Pengurus</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Pengurus</h4>
            <div class="basic-form">
                <form action="/pengurus/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="text-label">Anggota</label>
                        <select name="id_anggota" class="js-example-placeholder-multiple form-control">
                          @foreach ($anggota as $item)
                            <option value="{{ $item->id }}">{{ $item->pengguna->user->name }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Jabatan</label>
                      <select name="jabatan" class="js-example-placeholder-multiple form-control">
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Pengawas 1">Pengawas 1</option>
                        <option value="Pengawas 2">Pengawas 2</option>
                        <option value="Administrasi 1">Administrasi 1</option>
                        <option value="Administrasi 2">Administrasi 2</option>
                        <option value="Operator Toko 1">Operator Toko 1</option>
                        <option value="Operator Toko 2">Operator Toko 2</option>
                        <option value="Operator Toko 3">Operator Toko 3</option>
                        <option value="Operator Toko 4">Operator Toko 4</option>
                        <option value="Operator Toko 5">Operator Toko 5</option>
                        <option value="Operator Toko 6">Operator Toko 6</option>
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
