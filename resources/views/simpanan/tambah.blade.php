@extends('templates.index')

@section('title', 'ekopz | Simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Simpanan</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Simpanan</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="card-content">
  <?php if (session('alert-danger')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> {{ session('alert-danger') }}
    </div>
  <?php endif; ?>
</div>
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Simpanan</h4>
            <div class="basic-form">
                <form action="/simpanan/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="text-label">Anggota</label>
                        <select name="id_anggota" class="js-example-placeholder-multiple form-control">
                          @foreach ($anggota as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Jenis Simpanan</label>
                      <select name="jenis" class="js-example-placeholder-multiple form-control">
                        @foreach ($jenis as $value)
                          <option value="{{ $value->id }}">{{ $value->jenis }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Jumlah</label>
                      <input type="text" class="form-control" name="jumlah">

                      @if($errors->has('jumlah'))
                          <div class="text-danger">
                            {{ $errors->first('jumlah') }}
                          </div>
                      @endif
                    </div>

                    {{-- <div class="form-group">
                      <label class="text-label">Status Simpanan</label>
                      <select name="status" class="js-example-placeholder-multiple form-control">
                        <option value="1">Simpanan Masuk</option>
                        <option value="2">Simpanan Keluar</option>
                      </select>
                    </div> --}}

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/simpanan" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
