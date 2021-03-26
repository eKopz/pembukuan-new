@extends('templates.index')

@section('title', 'ekopz | Transaksi simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Transaksi simpanan</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Transaksi simpanan</li>
        </ol>
    </div>
@endsection


@section('content')
    
    <div class="row">
        <div class="col">
            <div class="card transparent-card">
                <h4 class="card-title">Transaksi simpanan</h4>
                <div class="doctor-list pt-4">
                    @foreach ($simpanan as $item)
                        <div class="media bg-white">
                            @if ($item->status == 1)
                                <img class="mr-3 rounded-circle" alt="image" src="{{ asset('assets/images/simpan_pinjam/masuk.png') }}">
                                <div class="media-body">
                                    <h5 class="mt-2 text-pale-sky">{{ $item->anggota->pengguna->user->name }}</h5>
                                    <h6 class="text-success mb-0">{{ $item->jenis_simpanan->jenis }}</h6>
                                    <h6 class="text-muted mb-0">{{ $item->created_at }}</h6>
                                </div>
                                <p class="text-muted mt-4 font-small">+ Rp. {{ number_format($item->jumlah,0,',','.') }}</p>
                            @else 
                                <img class="mr-3 rounded-circle" alt="image" src="{{ asset('assets/images/simpan_pinjam/keluar.png') }}">
                                <div class="media-body">
                                    <h5 class="mt-2 text-pale-sky">{{ $item->anggota->pengguna->user->name }}</h5>
                                    <h6 class="text-danger mb-0">{{ $item->jenis_simpanan->jenis }}</h6>
                                    <h6 class="text-muted mb-0">{{ $item->created_at }}</h6>
                                </div>
                                <p class="text-muted mt-4 font-small">- Rp. {{ number_format($item->jumlah,0,',','.') }}</p>
                            @endif
                            
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{  $simpanan->links()  }}
            </div>
        </div>
    </div>
@endsection
