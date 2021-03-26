@extends('templates.index')

@section('title', 'ekopz | Pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Pinjaman</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Pinjaman</li>
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
                                <h5>{{ $anggota->pengguna->user->name }}</h5>
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
                                    <h5><span class="h1 text-danger ">Rp. {{  number_format($anggota->pinjaman,0,',','.')  }}</span> <span class="d-block">Saldo Pinjaman</span></h5>
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
            <h4 class="card-title mb-4">Rekap Pinjaman</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-success">
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Pokok</th>
                            <th>Jasa</th>
                            <th>Provisi</th>
                            <th>Pinalty</th>
                            <th>Saldo Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Saldo Per Januari {{ $tahun_sebelumnya }}</td>
                            <td>@if ($jumlah_pinjaman == 0) - @else Rp. {{ number_format($jumlah_pinjaman,0,',','.') }} @endif </td>
                            <td> -  </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td>@if ($jumlah_pinjaman == 0) - @else Rp. {{ number_format($jumlah_pinjaman,0,',','.') }} @endif </td>                              
                        </tr>
                        @foreach ($pinjaman as $key => $pj)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>@if ($pj->first())
                                        @if ($pj->angsuran->first()->angsuran == 1)
                                            Rp. {{ number_format($pj->first()->pinjaman->jumlah_pinjaman,0,',','.') }}  
                                        @else
                                            -                                            
                                        @endif 
                                    @else 
                                        - 
                                    @endif
                                </td>
                                <td>@if ($pj->first()) Rp. {{ number_format($pj->first()->pinjaman->jumlah_pinjaman / $pj->first()->pinjaman->jumlah_cicilan,0,',','.') }} @else - @endif </td>
                                <td>@if ($pj->first()) Rp. {{ number_format($pj->first()->pinjaman->jumlah_pinjaman * $pj->first()->pinjaman->jumlah_cicilan / 100 / $pj->first()->pinjaman->jumlah_cicilan,0,',','.') }} @else - @endif </td>
                                <td>
                                    @if ($pj->first())
                                        @if ($pj->angsuran->first()->angsuran == 1)
                                            Rp. {{ number_format($pj->first()->pinjaman->jumlah_pinjaman * 0.005 ,0,',','.') }}  
                                        @else
                                            -                                            
                                        @endif 
                                    @else 
                                        - 
                                    @endif
                                </td>
                                <td> - </td> 
                                <td>@if ($pj->total->first()) Rp. {{ number_format($pj->total->first()->saldo,0,',','.') }} @else - @endif</td>                             
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
