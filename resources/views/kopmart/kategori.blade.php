@extends('templates.index')

@section('title', 'ekopz | KopMart')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data Kategori</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">KopMart</a>
            </li>
            <li class="breadcrumb-item active text-success">Data Kategori</li>
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
              <h4 class="card-title">Data Kategori</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                {{-- <a href="/kas/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                <i class="fa fa-plus color-info"></i> </span>Tambah Data</a> --}}

                  <table class="example-style display" style="min-width: 845px; color: black;">
                  <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item[0]->kategori }}</td>
                            <td>{{ $item[0]->jumlah }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                  </tfoot>
              </table>
              </div>
          </div>
      </div>
  </div>
@endsection