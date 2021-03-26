@extends('templates.index')

@section('title', 'ekopz | Kopmart')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Kopmart</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Kopmart</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Kopmart</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Kopmart</h4>
            <div class="basic-form">
                <form action="/kopmart/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="text-label">Nama Toko</label>
                        <input type="text" name="nama" class="form-control">

                        @if($errors->has('nama'))
                            <div class="text-danger">
                                {{ $errors->first('nama') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-label">Kategori Toko</label>
                        <select name="id_kategori_toko" class="form-control">
                            @foreach ($kategori_toko as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control">

                        @if($errors->has('alamat'))
                            <div class="text-danger">
                                {{ $errors->first('alamat') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-label">No Telepon</label>
                        <input type="text" name="no_hp" class="form-control">

                        @if($errors->has('no_hp'))
                            <div class="text-danger">
                                {{ $errors->first('no_hp') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-label">Email</label>
                        <input type="email" name="email" class="form-control">

                        @if($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="text-label">Password</label>
                        <input type="password" name="password" class="form-control">

                        @if($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
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
