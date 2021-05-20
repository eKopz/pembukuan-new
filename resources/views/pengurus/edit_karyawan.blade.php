@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Tambah Karyawan</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Edit Karyawan</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Karyawan</h4>
            <div class="basic-form">
                <form action="/pengurus/karyawan/update/{{ $karyawan->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label class="text-label">Anggota</label>
                      <select name="id_anggota" class="js-example-placeholder-multiple form-control">
                        @foreach ($anggota as $item)
                          <option @if ($karyawan->id_anggota == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Loker</label>
                    <input type="text" class="form-control" value="{{ $karyawan->loker }}" name="loker">

                    @if($errors->has('loker'))
                        <div class="text-danger">
                          {{ $errors->first('loker') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Status Kerja</label>
                    <select name="status" class="form-control">
                      <option @if ($karyawan->status == 1) selected @endif value="1">Tetap</option>
                      <option @if ($karyawan->status == 2) selected @endif value="2">Kontrak</option>
                      <option @if ($karyawan->status == 3) selected @endif value="3">Tenaga Lepas Harian (TLH)</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Gaji Pokok</label>
                    <input type="text" class="form-control" value="{{ $karyawan->gaji_pokok }}" name="gaji_pokok">

                    @if($errors->has('gaji_pokok'))
                        <div class="text-danger">
                          {{ $errors->first('gaji_pokok') }}
                        </div>
                    @endif
                  </div>

                  <h4 class="text-success">Perbankan</h4>
                  <hr class="mb-4">

                  <div class="form-group">
                    <label class="text-label">Nama Bank</label>
                    <input type="text" class="form-control" value="{{ $karyawan->bank }}" name="bank">

                    @if($errors->has('bank'))
                        <div class="text-danger">
                          {{ $errors->first('bank') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">No Rekening</label>
                    <input type="text" class="form-control" value="{{ $karyawan->no_rekening }}" name="no_rekening">

                    @if($errors->has('no_rekening'))
                        <div class="text-danger">
                          {{ $errors->first('no_rekening') }}
                        </div>
                    @endif
                  </div>

                  <h4 class="text-success">PTKP</h4>
                  <hr class="mb-4">

                  <div class="form-group">
                    <label class="text-label">Status (Menurut Aturan Pajak)</label>
                    <select name="id_pajak" class="form-control">
                      @foreach ($pajak as $item)
                        <option @if ($karyawan->id_pajak == $item->id) selected @endif value="{{ $item->id }}">{{ $item->kode }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group" id="jumlah_pajak">
                    <label class="text-label">PTKP (s.d)</label>
                    <input type="text" class="form-control" value="Rp. {{ $karyawan->jumlah_pajak }}" readonly>

                    @if($errors->has('jumlah_pajak'))
                        <div class="text-danger">
                          {{ $errors->first('jumlah_pajak') }}
                        </div>
                    @endif
                  </div>

                  <h4 class="text-success">Potong Gaji</h4>
                  <hr class="mb-4">

                  <div id="form_potong_gaji">
                    <div class="form-group">
                      <label class="text-label">Simpanan</label>
                      <select name="simpanan" class="form-control">
                        <option @if ($karyawan->simpanan == 0) selected @endif value="0">Tidak Aktif</option>
                        <option @if ($karyawan->simpanan == 1) selected @endif value="1">Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="text-label">Simpanan Pokok</label>
                      <select name="simpanan_pokok" class="form-control">
                        <option @if ($karyawan->simpanan_pokok == 0) selected @endif value="0">Tidak Aktif</option>
                        <option @if ($karyawan->simpanan_pokok == 1) selected @endif value="1">Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="text-label">Simpanan Wajib</label>
                      <select name="simpanan_wajib" class="form-control">
                        <option @if ($karyawan->simpanan_wajib == 0) selected @endif value="0">Tidak Aktif</option>
                        <option @if ($karyawan->simpanan_wajib == 1) selected @endif value="1">Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="text-label">Pinjaman</label>
                      <select name="pinjaman" class="form-control">
                        <option @if ($karyawan->pinjaman == 0) selected @endif value="0">Tidak Aktif</option>
                        <option @if ($karyawan->pinjaman == 1) selected @endif value="1">Aktif</option>
                      </select>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Simpan</button>
                  <a href="/pengurus" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
