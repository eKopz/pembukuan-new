@extends('templates.index')

@section('title', 'ekopz | pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah pinjaman</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah pinjaman</li>
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
            <h4 class="card-title mb-4">Form Tambah Pengajuan pinjaman</h4>
            <div class="basic-form">
                <form action="/pinjaman/pengajuan/hitung" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">Anggota</label>
                      <select name="id_anggota" class="js-example-placeholder-multiple form-control">
                        @foreach ($anggota as $item)
                          <option value="{{ $item->id }}">{{ $item->no_anggota }} - {{ $item->nama }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Jumlah Pinjaman</label>
                      <input type="text" class="form-control" name="jumlah">

                      @if($errors->has('jumlah'))
                          <div class="text-danger">
                            {{ $errors->first('jumlah') }}
                          </div>
                      @endif
                    </div>

                    <div class="form-group">
                      <label class="text-label">Cicilan</label>
                      <input type="number" class="form-control" name="cicilan">

                      @if($errors->has('cicilan'))
                          <div class="text-danger">
                            {{ $errors->first('cicilan') }}
                          </div>
                      @endif
                    </div>

                  <button type="submit" class="btn btn-success btn-sm btn-block">Hitung Angsuran</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
