@extends('templates.index')

@section('title', 'ekopz | Pengajuan Penarikan Simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Pengajuan Penarikan Simpanan</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Pengajuan Penarikan Simpanan</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg no-card-border">
            <div class="card user-card5">
                <div class="row m-0">
                    <div class="col-md-5 p-0">
                        @if (!$simpanan->anggota->pengguna->foto || $simpanan->anggota->pengguna->foto == null )
                            <img src="{{ asset('assets/images/user/6.jpg') }}" alt="" class="img-fluid w-100">
                        @else
                            <img src="{{ $simpanan->anggota->pengguna->foto }}" alt="" class="img-fluid w-100">
                        @endif
                    </div>
                    <div class="col-md-7 mt-4">
                        <div class="card-body py-0 px-4">
                            <div class="my-3">
                                <p class="mb-0">No Anggota</p>
                                <h5>{{ $simpanan->anggota->no_anggota }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Nama</p>
                                <h5>{{ $simpanan->anggota->nama }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">No KTP</p>
                                @if ($simpanan->anggota->pengguna->noktp)
                                    <h5>{{ $simpanan->anggota->pengguna->noktp }}</h5>
                                @else
                                    <h5>Tidak Diketahui</h5>
                                @endif
                                
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Karyawan</p>
                                <h5>{{ $simpanan->anggota->karyawan->karyawan }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Status Penarikan Simpanan</p>
                                @if ($simpanan->status == 1)
                                    <h4 class="text-danger">Belum Disetujui</h4>
                                @elseif ($simpanan->status == 2)
                                    <h4 class="text-success">Sudah Disetujui</h4>
                                @else
                                    <h4 class="text-danger">Ditolak</h4>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row pt-3">
                        <div class="col">
                            <div class="records-collection-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="py-1"><h5><b>Saldo Simpanan Manasuka</b></h5></td>
                                            <td class="text-right py-1">
                                                <span ><h5><b>Rp. {{ number_format($simpanan->anggota->simpanan,0,',','.') }}</b></h5></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">Jumlah Ditarik</td>
                                            <td class="py-1 text-right">
                                                <span>Rp. {{  number_format($simpanan->jumlah,0,',','.') }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Verifikasi</h4>
                    <div class="basic-form">
                        <form action="/simpanan/penarikan/verifikasi/{{ $simpanan->id }}" method="POST">
                            @csrf

                            <select name="verifikasi" class="form-control mb-4">
                                <option value="2">Setujui</option>
                                <option value="3">Tolak</option>
                            </select>

                            <input type="submit" class="btn btn-success btn-lg btn-block" value="Verifikasi">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

