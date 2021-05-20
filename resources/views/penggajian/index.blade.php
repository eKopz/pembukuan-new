@extends('templates.index')

@section('title', 'ekopz | Kas')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data Gaji</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Gaji</a>
            </li>
            <li class="breadcrumb-item active text-success">Data Gaji</li>
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
                <h4 class="card-title">Data Gaji</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="/gaji/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                    <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>

                    <a href="#" class="btn btn-rounded btn-warning" data-toggle="modal" data-target="#exportModal" style="margin-bottom: 20px"><span class="btn-icon-left text-warning">
                        <i class="fa fa-print color-info"></i> </span>Export Data</a>

                    <table class="example-style display" style="min-width: 845px; color: black;">
                    <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($gaji as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->created_at->format('M Y') }}</td>
                                <td>{{ $value->karyawan_koperasi->anggota->nama }}</td>
                                <td>Rp. {{ number_format($value->total_gaji,0,',','.') }}</td>
                                <td>
                                    @if ($value->status == 1)
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($value->status == 1)
                                        <a href="/gaji/detail/{{ $value->id }}" class="btn btn-success btn-xs">Detail</a>
                                        <a href="/gaji/bukti/{{ $value->id }}" class="btn btn-warning btn-xs">Upload Bukti</a>
                                    @else
                                        <a href="/gaji/detail/{{ $value->id }}" class="btn btn-success btn-xs">Detail</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Status</th>
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
                <form action="/kas/export" method="POST">
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