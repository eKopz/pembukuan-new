@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Gaji</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Gaji</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Gaji</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-8">
                    <h3 class="text-success">Detail Gaji</h3>
                </div>
                <div class="col-4">
                    @if ($gaji->status == 1)
                        <h2><span class="badge badge-warning float-right">Pending</span></h2>
                    @else
                        <h2><span class="badge badge-success float-right">Selesai</span></h2>
                    @endif
                </div>
            </div>
            <div class="basic-form">
                <h4 class="text-success">Data Diri</h4>
                <hr size="2" class="mb-4" style="border-top: 2px solid green">

                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Nama</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">{{ $gaji->karyawan_koperasi->anggota->nama }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Jenis Kelamin</p>
                        </div>
                        <div class="col-4">
                            @if ($gaji->karyawan_koperasi->anggota->pengguna->jenis_kelamin != null)
                                <p class="text-dark text-right">{{ $gaji->karyawan_koperasi->anggota->pengguna->jenis_kelamin }}</p>
                            @else
                                <p class="text-dark text-right">Tidak Diketahui</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Loker</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">{{ $gaji->karyawan_koperasi->loker }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Status Kerja</p>
                        </div>
                        <div class="col-4">
                            @if ($gaji->karyawan_koperasi->status == 1)
                                <p class="text-dark text-right">Tetap</p>
                            @elseif($gaji->karyawan_koperasi->status == 2)
                                <p class="text-dark text-right">Kontrak</p>
                            @elseif($gaji->karyawan_koperasi->status == 3)
                                <p class="text-dark text-right">Tenaga Lepas Harian (TLH)</p>
                            @else
                                <p class="text-dark text-right">Keluar</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Gaji Pokok</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->karyawan_koperasi->gaji_pokok,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">No Rekening</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">{{ $gaji->karyawan_koperasi->no_rekening }}</p>
                        </div>
                    </div>
                </div>

                <h4 class="text-success">Tunjangan</h4>
                <hr size="2" class="mb-4" style="border-top: 2px solid green">

                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Makan</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->makan,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Transport</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->transport,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Insentif</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->insentif,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Lembur</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->lembur,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mt-5">
                        <div class="col-8">
                            <h5 class="text-success">Gaji Per Bulan</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="text-success text-right">Rp. {{ number_format($gaji->karyawan_koperasi->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->lembur,0,',','.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <div class="col-8">
                            <h5 class="text-success">Gaji Per Tahun</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="text-success text-right">Rp. {{ number_format(($gaji->karyawan_koperasi->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->lembur) * 12,0,',','.') }}</h5>
                        </div>
                    </div>
                </div>

                <h4 class="text-success">PTKP</h4>
                <hr size="2" class="mb-4" style="border-top: 2px solid green">

                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Status (Menurut Aturan Pajak)</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">{{ $gaji->karyawan_koperasi->pajak->kode }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">PTKP (s.d)</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->karyawan_koperasi->pajak->total_gaji,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Rapel</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->rapel,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Jamsostek</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->jamsostek,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <div class="col-8">
                            <h5 class="text-success">Sub Total</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="text-success text-right">Rp. {{ number_format($gaji->karyawan_koperasi->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->rapel + $gaji->jamsostek,0,',','.') }}</h5>
                        </div>
                    </div>
                </div>

                <h4 class="text-success">Potongan</h4>
                <hr size="2" class="mb-4" style="border-top: 2px solid green">

                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Simpanan Wajib</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->potongan_simpanan_wajib,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Simpanan Pokok</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->potongan_simpanan_pokok,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Simpanan Manasuka</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->potongan_simpanan,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Angsuran Pinjaman</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->potongan_pinjaman,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Mangkir</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->mangkir,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Jamsostek</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($gaji->jamsostek,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <p class="text-dark">Pph 21</p>
                        </div>
                        <div class="col-4">
                            <p class="text-dark text-right">Rp. {{ number_format($pph,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <div class="col-8">
                            <h5 class="text-success">Total</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="text-success text-right">Rp. {{ number_format($gaji->total_gaji,0,',','.') }}</h5>
                        </div>
                    </div>
                </div>

                <a href="/gaji" class="btn btn-light text-dark btn-form">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
