@extends('templates.index')

@section('title', 'ekopz | Kas')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Kas</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Kas</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Kas</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Kas</h4>
            <div class="basic-form">
                <form action="/kas/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="text-label">Uraian</label>
                        <input type="text" name="uraian" class="form-control">

                        @if($errors->has('uraian'))
                            <div class="text-danger">
                                {{ $errors->first('uraian') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-label">Jenis Kas</label>
                        <select name="jenis_kas" class="js-example-placeholder-multiple form-control">
                            <option value="1">Kas Masuk</option>
                            <option value="2">Kas Keluar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control">

                        @if($errors->has('jumlah'))
                            <div class="text-danger">
                                {{ $errors->first('jumlah') }}
                            </div>
                        @endif
                    </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/kas" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
