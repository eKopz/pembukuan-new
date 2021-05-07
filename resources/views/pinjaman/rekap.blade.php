@extends('templates.index')

@section('title', 'ekopz | pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Rekap pinjaman</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Rekap pinjaman</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="col-12 mt-0">
        <div class="card-content">
            <?php if (session('alert-success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button> {{ session('alert-success') }}
            </div>
            <?php endif; ?>
        </div>
        <div class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title">Rekap pinjaman</h4>
                </div>
                <div class="card-body">
                    <a href="/pinjaman/angsuran/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                    <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>

                    <a href="#" class="btn btn-rounded btn-warning" data-toggle="modal" data-target="#exportModal" style="margin-bottom: 20px"><span class="btn-icon-left text-warning">
                        <i class="fa fa-print color-info"></i> </span>Export Data</a>

                        <div class="table-responsive">
                            <table class="example-style display" style="min-width: 845px; color: black;">
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jumlah Pinjaman</th>
                                            <th>Jumlah Cicilan</th>
                                            <th>Sisa Angsuran</th>
                                            <th>Pembayaran Pokok</th>
                                            <th>Saldo Pinjaman</th>
                                            <th>Aksi</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pinjaman as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->anggota->nama }}</td>
                                            <td>Rp. {{ number_format($item->jumlah_pinjaman,0,',','.') }}</td>
                                            <td>{{ $item->jumlah_cicilan }}x</td>
                                            <td>{{ $item->jumlah_cicilan - $item->angsuran }}x</td>
                                            <td>Rp. {{ number_format($item->jumlah_pinjaman / $item->jumlah_cicilan,0,',','.') }}</td>
                                            <td>Rp. {{ number_format($item->anggota->pinjaman,0,',','.') }}</td>
                                            <td>
                                                <a href="/pinjaman/detail/{{ $item->id }}" class="btn btn-primary btn-xs">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jumlah Pinjaman</th>
                                            <th>Jumlah Cicilan</th>
                                            <th>Sisa Angsuran</th>
                                            <th>Pembayaran Pokok</th>
                                            <th>Saldo Pinjaman</th>
                                            <th>Aksi</th>
                                        </tr>
                                </tfoot>
                            </table>
                        </div>
                </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input Rentang Bulan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <?php 
                    $year = date('Y');
                    $min = $year - 60;
                    $max = $year;     
                ?>
                <form action="/pinjaman/export" method="POST">
                    @csrf

                    <label class="text-label">Tahun</label>
                    <select name="tahun" class="form-control mb-4">
                        @for ($i=$max; $i>=$min; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <label class="text-label">Mulai Bulan</label>
                    <select name="mulai" class="form-control mb-4">
                        @for ($i=1; $i<=12; ++$i)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                    
                    <label class="text-label">Sampai Bulan</label>
                    <select name="selesai" class="form-control mb-4">
                        @for ($i=1; $i<=12; ++$i)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-Warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Export Data</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
