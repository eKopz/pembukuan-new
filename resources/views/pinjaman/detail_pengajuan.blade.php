@extends('templates.index')

@section('title', 'ekopz | Pengajuan Pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Pengajuan Pinjaman</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Pengajuan Pinjaman</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg no-card-border">
            <div class="card user-card5">
                <div class="row m-0">
                    <div class="col-md-5 p-0">
                        @if (!$pinjaman->anggota->pengguna->foto || $pinjaman->anggota->pengguna->foto == null )
                            <img src="{{ asset('assets/images/user/6.jpg') }}" alt="" class="img-fluid w-100">
                        @else
                            <img src="{{ $pinjaman->anggota->pengguna->foto }}" alt="" class="img-fluid w-100">
                        @endif
                    </div>
                    <div class="col-md-7 mt-4">
                        <div class="card-body py-0 px-4">
                            <div class="my-3">
                                <p class="mb-0">No Anggota</p>
                                <h5>{{ $pinjaman->anggota->no_anggota }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Nama</p>
                                <h5>{{ $pinjaman->anggota->nama }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">No KTP</p>
                                @if ($pinjaman->anggota->pengguna->noktp)
                                    <h5>{{ $pinjaman->anggota->pengguna->noktp }}</h5>
                                @else
                                    <h5>Tidak Diketahui</h5>
                                @endif
                                
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Karyawan</p>
                                <h5>{{ $pinjaman->anggota->karyawan->karyawan }}</h5>
                            </div>
                            <div class="my-3 mt-4">
                                <p class="mb-0">Status Pinjaman</p>
                                @if ($pinjaman->status == 1)
                                    <h4 class="text-danger">Belum Disetujui</h4>
                                @elseif ($pinjaman->status == 2)
                                    <h4 class="text-success">Sudah Disetujui</h4>
                                @else
                                    <h4 class="text-success">Selesai</h4>
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
                    <h4 class="card-title mb-5">Detail Pinjaman</h4>
                    <div class="row pt-3">
                        <div class="col">
                            <div class="records-collection-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="py-1"><h5><b>Jumlah Pinjaman</b></h5></td>
                                            <td class="text-right py-1">
                                                <span ><h5><b>Rp. {{ number_format($pinjaman->jumlah_pinjaman,0,',','.') }}</b></h5></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">Provisi</td>
                                            <td class="py-1 text-right">
                                                <span>Rp. {{  number_format($pinjaman->jumlah_pinjaman * 0.005 ,0,',','.') }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">Jasa</td>
                                            <td class="py-1 text-right">
                                                <span>Rp. {{ number_format($pinjaman->jumlah_pinjaman * $pinjaman->jumlah_cicilan / 100 / $pinjaman->jumlah_cicilan,0,',','.') }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-1">Jumlah Cicilan</td>
                                            <td class="py-1 text-right">
                                                <span>{{ $pinjaman->jumlah_cicilan }}</span>
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
        <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="card">
                <div class="card-body stat-widget-seven gradient-1">
                    <div class="media align-items-center ml-3">
                        <div class="media-body">
                            <h2 class="mt-0 mb-2">{{ $pinjaman_berjalan }}</h2>
                            <h5 class="text-uppercase">Pinjaman Masih Berjalan</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-6 col-sm-6">
            <div class="card">
                <div class="card-body stat-widget-seven gradient-1">
                    <div class="media align-items-center ml-3">
                        <div class="media-body">
                            <h2 class="mt-0 mb-2">0</h2>
                            <h5 class="text-uppercase">Pinalty</h5>
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
                    <h4 class="card-title mb-5">Keterangan</h4>
                    <div class="basic-form">
                        <form action="">
                            <textarea name="keterangan" class="form-control" cols="30" rows="10" readonly>{{ $pinjaman->keterangan }}</textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
