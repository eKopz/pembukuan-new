@extends('templates.index')

@section('title', 'ekopz | simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Rekap Simpanan</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Rekap Simpanan</li>
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
                <h4 class="card-title">Rekap Simpanan</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <a href="/simpanan/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                    <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>

                    <a href="/simpanan/export" class="btn btn-rounded btn-warning" style="margin-bottom: 20px"><span class="btn-icon-left text-warning">
                    <i class="fa fa-print color-info"></i> </span>Export Data</a>

                    <a href="#" class="btn btn-rounded btn-secondary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#importModal"><span class="btn-icon-left text-secondary">
                        <i class="fa fa-file-excel-o color-info"></i> </span>Import Data</a>

                    <table class="example-style display" style="min-width: 845px; color: black;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Simpanan Pokok</th>
                            <th>Simpanan Wajib</th>
                            <th>Simpanan Manasuka</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggota as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp. {{ number_format($item->simpanan_pokok,0,',','.') }}</td>
                                <td>Rp. {{ number_format($item->simpanan_wajib,0,',','.') }}</td>
                                <td>Rp. {{ number_format($item->simpanan,0,',','.') }}</td>
                                <td>Rp. {{ number_format($item->simpanan_pokok + $item->simpanan_wajib + $item->simpanan,0,',','.') }}</td>
                                <td>
                                    <a href="/simpanan/detail/{{ $item->id }}" class="btn btn-primary btn-xs">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Simpanan Pokok</th>
                            <th>Simpanan Wajib</th>
                            <th>Simpanan Manasuka</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="importModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/simpanan/add/import" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <input type="file" class="form-control" name="import_data">
                        <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">Kembali</button>
                        <input type="submit" class="btn btn-success mt-5" value="Import Data">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
