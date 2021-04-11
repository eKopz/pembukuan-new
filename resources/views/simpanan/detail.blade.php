@extends('templates.index')

@section('title', 'ekopz | Simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Simpanan</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Simpanan</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg no-card-border">
            <div class="card user-card5">
                <div class="row m-0">
                    <div class="col-md-5 p-0">
                        @if ($anggota->pengguna->foto)
                            <img src="{{ $anggota->pengguna->foto }}" alt="" class="img-fluid w-100">
                        @else
                            <img src="../../assets/images/user/6.jpg" alt="" class="img-fluid w-100">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="card-body py-0 px-4">
                            <div class="my-3">
                                <p class="mb-0">No Anggota</p>
                                <h5>{{ $anggota->no_anggota }}</h5>
                            </div>
                            <div class="my-3">
                                <p class="mb-0">Nama</p>
                                <h5>{{ $anggota->nama }}</h5>
                            </div>
                            <div class="my-3">
                                <p class="mb-0">No KTP</p>
                                @if ($anggota->pengguna->noktp)
                                    <h5>{{ $anggota->pengguna->noktp }}</h5>
                                @else
                                    <h5>Tidak Diketahui</h5>
                                @endif
                            </div>
                            <div class="border-bottom-1 my-3 pb-3">
                                <p class="mb-0">Karyawan</p>
                                <h5>{{ $anggota->karyawan->karyawan }}</h5>
                            </div>
                            <div class="row mt-2">
                                <div class="col-10">
                                    <h5><span class="h1 text-success ">Rp. {{ number_format($anggota->simpanan,0,',','.') }}</span> <span class="d-block">Simpanan</span></h5>
                                </div>
                                <div class="col-10">
                                    <h5><span class="h1 text-success ">Rp. {{ number_format($anggota->simpanan_pokok,0,',','.') }}</span> <span class="d-block">Simpanan Pokok</span></h5>
                                </div>
                                <div class="col-10">
                                    <h5><span class="h1 text-success ">Rp. {{ number_format($anggota->simpanan_wajib,0,',','.') }}</span> <span class="d-block">Simpanan Wajib</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Rekap Simpanan</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-success">
                        <tr>
                            <th>Bulan</th>
                            <th>Simpanan Manasuka</th>
                            <th>Simpanan Pokok</th>
                            <th>Simpanan Wajib</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Saldo Per Januari {{ $tahun_sebelumnya }}</td>
                            <td>@if ($totalSimpanan == 0) Rp. 0 @else Rp. {{ number_format($totalSimpanan,0,',','.') }} @endif </td>
                            <td>@if ($totalSimpananPokok == 0) Rp. 0 @else Rp. {{ number_format($totalSimpananPokok,0,',','.') }} @endif </td>
                            <td>@if ($totalSimpananWajib == 0) Rp. 0 @else Rp. {{ number_format($totalSimpananWajib,0,',','.') }} @endif </td>
                            <td>@if ($totalAllSimpanan == 0) Rp. 0 @else Rp. {{ number_format($totalAllSimpanan,0,',','.') }} @endif </td>                              
                        </tr>
                        @foreach ($simpanan as $key => $sm)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>@if ($sm->where('id_jenis_simpanan', 1)->first()) Rp. {{ number_format($sm->where('id_jenis_simpanan', 1)->first()->jumlah,0,',','.') }} @else Rp. 0 @endif </td>
                                <td>@if ($sm->where('id_jenis_simpanan', 2)->first()) Rp. {{ number_format($sm->where('id_jenis_simpanan', 2)->first()->jumlah,0,',','.') }} @else Rp. 0 @endif </td>
                                <td>@if ($sm->where('id_jenis_simpanan', 3)->first()) Rp. {{ number_format($sm->where('id_jenis_simpanan', 3)->first()->jumlah,0,',','.') }} @else Rp. 0 @endif </td>
                                <td>@if ($sm->total->first()->saldo) Rp. {{ number_format($sm->total->first()->saldo,0,',','.') }} @else Rp. 0 @endif </td>                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
