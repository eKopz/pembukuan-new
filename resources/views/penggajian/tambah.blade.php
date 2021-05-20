@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Gaji</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Gaji</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Tambah Gaji</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Tambah Gaji</h4>
            <div class="basic-form">
                <form action="/gaji/tambah/potongan" method="post" multiple="multiple" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label class="text-label">Karyawan Koperasi</label>
                      <select name="id_karyawan_koperasi" class="js-example-placeholder-multiple form-control">
                        @foreach ($karyawan as $item)
                          <option value="{{ $item->id }}">{{ $item->anggota->nama }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group" id="gaji_pokok">
                    <label class="text-label">Gaji Pokok</label>
                    <div class="row">
                      <div class="col-10">
                        <input type="text" class="form-control" name="gaji_pokok" readonly>
                      </div>
                      <div class="col-2 mt-4">
                        <a href="#" class="text-success">Ubah Gaji Pokok</a>
                      </div>
                    </div>
                  </div>

                  <h4 class="text-success mt-4">Tunjangan</h4>
                  <hr class="mb-4">

                  <div class="form-group">
                    <label class="text-label">Makan (hari)</label>
                    <input type="number" class="form-control" name="makan">

                    @if($errors->has('makan'))
                      <div class="text-danger">
                        {{ $errors->first('makan') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Transport (hari)</label>
                    <input type="number" class="form-control" name="transport">

                    @if($errors->has('transport'))
                      <div class="text-danger">
                        {{ $errors->first('transport') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Insentif</label>
                    <input type="number" class="form-control" name="insentif">

                    @if($errors->has('insentif'))
                      <div class="text-danger">
                        {{ $errors->first('insentif') }}
                      </div>
                    @endif
                  </div>

                  <h4 class="text-success mt-4">Rapel dan Jamsostek</h4>
                  <hr class="mb-4">

                  <div class="form-group">
                    <label class="text-label">Rapel</label>
                    <input type="text" class="form-control" name="rapel">

                    @if($errors->has('rapel'))
                        <div class="text-danger">
                          {{ $errors->first('rapel') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Jamsostek</label>
                    <input type="text" class="form-control" name="jamsostek">

                    @if($errors->has('jamsostek'))
                        <div class="text-danger">
                          {{ $errors->first('jamsostek') }}
                        </div>
                    @endif
                  </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Lanjut</button>
                  <a href="/gaji" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
