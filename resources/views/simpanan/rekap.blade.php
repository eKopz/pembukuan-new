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
                            <td>{{ $item->pengguna->user->name }}</td>
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
@endsection
