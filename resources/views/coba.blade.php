@extends('templates.index')

@section('title', 'ekopz | Koperasi')

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
        <?php if (session('status')): ?>
          <div class="alert alert-success alert-dismissible fade show">
              <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                      aria-hidden="true">&times;</span>
              </button> {{ session('status') }}
          </div>
        <?php endif; ?>
      </div>
      <div class="card">
          <div class="card-header pb-0">
              <h4 class="card-title">Data Anggota</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                <a href="/produk/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>

                  <table class="example-style display" style="min-width: 845px; color: black;">
                  <thead>
                      <tr>
                          <th>No. Anggota</th>
                          <th>Nama Produk</th>
                          <th>Harga</th>
                          <th>Stok</th>
                          <th>Kategori Barang</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>aldi</td>
                        <td>20.000</td>
                        <td>pakaian</td>
                        <td>12</td>
                    </tr>
                  </tbody>
                  <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori Barang</th>
                      </tr>
                  </tfoot>
              </table>
              </div>
          </div>
      </div>
  </div>
@endsection
