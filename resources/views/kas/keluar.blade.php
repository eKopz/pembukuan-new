@extends('templates.index')

@section('title', 'ekopz | Kas Keluar')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Rekap Kas Keluar</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Kas Keluar</a>
            </li>
            <li class="breadcrumb-item active text-success">Rekap Kas Keluar</li>
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
              <h4 class="card-title">Rekap Kas Keluar</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                  <table class="example-style display" style="min-width: 845px; color: black;">
                  <thead>
                        <tr>
                            <th>No. Bukti</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kas as $item)
                        <tr>
                            <td>{{ $item->no_bukti }}</td>
                            <td>{{ $item->uraian }}</td>
                            <td>Rp. {{ number_format($item->jumlah,0,',','.') }}</td>
                            <td>{{ $item->created_at->format('d M Y H:i:s') }}</td>
                            <td>{{ $item->updated_at->format('d M Y H:i:s') }}</td>
                            <td>
                                <a href="/kas/edit/{{ $item->id }}" class="btn btn-warning btn-xs">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                        <tr>
                            <th>No. Bukti</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Update</th>
                            <th>Aksi</th>
                        </tr>
                  </tfoot>
              </table>
              </div>
          </div>
      </div>
  </div>
@endsection
