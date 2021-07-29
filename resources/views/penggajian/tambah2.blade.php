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
                <form action="/gaji/add" method="post" multiple="multiple" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                      <label class="text-label">Karyawan Koperasi</label>
                      <input type="text" class="form-control" value="{{ $karyawan->anggota->nama }}" readonly>
                      <input type="text" class="form-control" name="id_karyawan_koperasi" value="{{ $karyawan->id }}" hidden>
                      </select>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Gaji Pokok</label>
                    <input type="text" class="form-control" name="gaji_pokok" value="{{ $karyawan->gaji_pokok }}" readonly>
                  </div>

                  <div class="form-group">
                    <label class="text-label">Makan</label>
                    <input type="number" class="form-control" name="makan" value="{{ $makan }}" readonly>

                    @if($errors->has('makan'))
                      <div class="text-danger">
                        {{ $errors->first('makan') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Transport</label>
                    <input type="number" class="form-control" name="transport" value="{{ $transport }}" readonly>
                    
                    @if($errors->has('transport'))
                      <div class="text-danger">
                        {{ $errors->first('transport') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Insentif</label>
                    <input type="number" class="form-control" name="insentif" value="{{ $insentif }}" readonly>

                    @if($errors->has('insentif'))
                      <div class="text-danger">
                        {{ $errors->first('insentif') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Lembur</label>
                    <input type="text" class="form-control" name="lembur" value="{{ $lembur }}" readonly>

                    @if($errors->has('lembur'))
                        <div class="text-danger">
                          {{ $errors->first('lembur') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Rapel</label>
                    <input type="text" class="form-control" name="rapel" value="{{ $rapel }}" readonly>

                    @if($errors->has('rapel'))
                        <div class="text-danger">
                          {{ $errors->first('rapel') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Jamsostek</label>
                    <input type="text" class="form-control" name="jamsostek" value="{{ $jamsostek }}" readonly>

                    @if($errors->has('jamsostek'))
                        <div class="text-danger">
                          {{ $errors->first('jamsostek') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group mt-4">
                    <div class="row">
                      <div class="col-9">
                        <h3 class="text-success">Sub Total</h3>
                      </div>
                      <div class="col-3" style="padding-left: 50px;">
                        <h3 class="text-success">Rp. {{ number_format($get_sub_total,0,',','.') }}</h3>
                      </div>
                    </div>
                  </div>

                  <h4 class="text-success mt-4">Potongan</h4>
                  <hr class="mb-4">

                  <div class="form-group">
                    <label class="text-label">Simpanan Wajib</label>
                    <input type="number" class="form-control potongan_simpanan_wajib" name="potongan_simpanan_wajib" @if ($karyawan->simpanan_wajib == 0) value="0" readonly @else value="50000" readonly @endif>

                    @if($errors->has('potongan_simpanan_wajib'))
                        <div class="text-danger">
                          {{ $errors->first('potongan_simpanan_wajib') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Simpanan Pokok</label>
                    <input type="number" class="form-control potongan_simpanan_pokok" name="potongan_simpanan_pokok" @if ($karyawan->simpanan_pokok == 0) value="0" readonly @else @if ($karyawan->anggota->simpanan_pokok > 0) value="0" readonly @else value="50000" readonly @endif @endif>

                    @if($errors->has('potongan_simpanan_pokok'))
                        <div class="text-danger">
                          {{ $errors->first('potongan_simpanan_pokok') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Simpanan Manasuka</label>
                    <input type="number" class="form-control potongan_simpanan" name="potongan_simpanan" @if ($karyawan->simpanan == 0) value="0" readonly @else  @endif>

                    @if($errors->has('potongan_simpanan'))
                        <div class="text-danger">
                          {{ $errors->first('potongan_simpanan') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Angsuran Pinjaman</label>
                    <input type="number" class="form-control potongan_pinjaman" name="potongan_pinjaman" @if ($karyawan->pinjaman == 0) value="0" readonly @else value="{{ $jumlah_pinjaman }}" readonly @endif>

                    @if($errors->has('potongan_pinjaman'))
                        <div class="text-danger">
                          {{ $errors->first('potongan_pinjaman') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Mangkir</label>
                    <input type="number" class="form-control mangkir" name="mangkir">

                    @if($errors->has('mangkir'))
                        <div class="text-danger">
                          {{ $errors->first('mangkir') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Jamsostek</label>
                    <input type="number" class="form-control jamsostek_2" name="jamsostek_2" value="{{ $jamsostek }}" readonly>

                    @if($errors->has('jamsostek_2'))
                        <div class="text-danger">
                          {{ $errors->first('jamsostek_2') }}
                        </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="text-label">Pph 21</label>
                    <input type="number" class="form-control pph" name="pph" value="{{ $pph }}" readonly>

                    @if($errors->has('pph'))
                        <div class="text-danger">
                          {{ $errors->first('pph') }}
                        </div>
                    @endif
                  </div>

                  {{-- <div class="form-group" id="total_gaji">
                    <label class="text-label">Total</label>
                    <input type="number" class="form-control" name="total" readonly>
                  </div> --}}

                  <button type="submit" class="btn btn-success btn-form mr-2">Tambah data</button>
                  <a href="/gaji" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
