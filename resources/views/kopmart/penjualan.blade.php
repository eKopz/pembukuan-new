@extends('templates.index')

@section('title', 'ekopz | KopMart')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data Penjualan</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">KopMart</a>
            </li>
            <li class="breadcrumb-item active text-success">Data Penjualan</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="card">
        <div class="mt-5 mb-4 ml-5">
            <h3>{{ $toko->nama }} - Data Penjualan</h3>
        </div>
        <div class="card ml-5" style="background-color: #DBE5E4; width: 95%;">
            <div class="card-body widget-campaign style-1">
                <div class="row">
                    <div class="col-xl-9">
                        <h2 class="text-success">Rp. <span>{{ number_format($penjualan->jumlah - $penghasilan,0,',','.') }}</span></h2>
                        <p class="tt-uppercase font-small mr-4">Saldo Penjual</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 ml-5">
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #5AA469">
                        <h4 class="card-title mb-4 text-white text-center">Total Order</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $order->jumlah }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #F8D49D">
                        <h4 class="card-title mb-4 text-white text-center">Total Pelanggan</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">{{ $pelanggan->jumlah }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 ml-4" >
                <div class="card chartjs-stat-card-1">
                    <div class="card-body" style="background-color: #D35D6E">
                        <h4 class="card-title mb-4 text-white text-center">Total Penjualan</h4>
                        <div class="col">
                            <h2 class="mt-0 mb-3 text-white text-center">@if ($penjualan->jumlah != null)
                               Rp. {{ number_format($penjualan->jumlah,0,',','.') }} 
                            @else
                               Rp. 0
                            @endif</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4 ml-5">
            <h4 class="text-success">Pesanan terbaru : </h4>
        </div>
        <div class="card ml-5" style="width: 95%">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="example-style display" style="min-width: 845px; color: black;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penerima</th>
                            <th>Tgl. Order</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->nama_penerima }}</td>
                                <td>{{ $value->tgl_order }}</td>
                                <td>{{ $value->jumlah }}</td>
                                <td>{{ $value->total }}</td>
                                <td>
                                    @if ($value->status == 1)
                                        pesanan dibuat
                                    @elseif ($value->status == 2)
                                        pesanan dibayarkan
                                    @elseif ($value->status == 3)
                                        pesanan diproses
                                    @elseif ($value->status == 4)
                                        pesanan dikirimkan
                                    @elseif ($value->status == 5)
                                        selesai
                                    @else
                                        pesanan dibatalkan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Penerima</th>
                            <th>Tgl. Order</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection