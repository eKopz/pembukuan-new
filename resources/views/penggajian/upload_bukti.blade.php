@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Upload Bukti Gaji</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Gaji</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Upload Bukti</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Upload Bukti Gaji</h4>
            <div class="basic-form">
                <form action="/gaji/bukti/{{ $gaji->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label class="text-label">Karyawan Koperasi</label>
                      <input type="text" value="{{ $gaji->karyawan_koperasi->anggota->nama }}" name="karyawan_koperasi" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Bulan</label>
                    <input type="text" value="{{ $gaji->created_at->format('M Y') }}" name="bulan" class="form-control" readonly>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Metode</label>
                    <select name="metode" class="form-control">
                        <option value="1">Cash</option>
                        <option value="2">Transfer</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Jumlah</label>
                    <input type="text" class="form-control" value="Rp. {{ number_format($gaji->total_gaji,0,',','.') }}" name="jumlah" readonly>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Upload Bukti</label>
                    <input type="file" class="form-control" name="bukti">

                    @if($errors->has('bukti'))
                      <div class="text-danger">
                        {{ $errors->first('bukti') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
                  </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Upload Bukti</button>
                  <a href="/gaji" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
