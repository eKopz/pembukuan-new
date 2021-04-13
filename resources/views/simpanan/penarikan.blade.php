@extends('templates.index')

@section('title', 'ekopz | simpanan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Penarikan Simpanan</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Simpanan</a>
            </li>
            <li class="breadcrumb-item active text-success">Penarikan Simpanan</li>
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
              <h4 class="card-title">Penarikan Simpanan</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                  <table class="example-style display" style="min-width: 845px; color: black;">
                  <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($simpanan as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->anggota->nama }}</td>
                            <td>Rp. {{ number_format($item->jumlah,0,',','.') }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="label label-danger">Belum Diverifikasi</span>
                                @else
                                    <span class="label label-success">Sudah Diverifikasi</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <a href="/simpanan/penarikan/verifikasi/{{ $item->id }}" class="btn btn-success btn-xs">Verifikasi</a>
                                @else
                                    
                                @endif
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
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