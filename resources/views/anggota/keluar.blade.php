@extends('templates.index')

@section('title', 'ekopz | Anggota')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data Anggota</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Anggota</a>
            </li>
            <li class="breadcrumb-item active text-success">Data Anggota</li>
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
              <h4 class="card-title">Data Anggota</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                <table class="example-style display" style="min-width: 845px; color: black;">
                    <thead>
                        <tr>
                            <th>No. Anggota</th>
                            <th>Nama</th>
                            <th>Karyawan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggota as $item)
                            <tr>
                                <td>{{ $item->no_anggota }}</td>
                                @if ($item->id_karyawan == null)
                                    <td>{{ $item->nama }}</td>
                                    <td>-</td>
                                @else
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->karyawan->karyawan }}</td> 
                                @endif
                                <td>
                                    <span class="label label-danger">Keluar</span>
                                </td>
                                <td>
                                    <a href="/anggota/detail/{{ $item->id }}" class="btn btn-primary btn-xs">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No. Anggota</th>
                            <th>Nama</th>
                            <th>Karyawan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
          </div>
      </div>
  </div>
@endsection
