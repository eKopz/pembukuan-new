@extends('templates.index')

@section('title', 'ekopz | Karyawan')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Data karyawan</h4>
        {{-- <h4>Hello {{ Auth::user()->name }}, <span>Selamat Datang di aplikasi Ekopz</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">karyawan</a>
            </li>
            <li class="breadcrumb-item active text-success">Data karyawan</li>
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
              <h4 class="card-title">Data Karyawan</h4>
          </div>
          <div class="card-body">

              <div class="table-responsive">
                <a href="/karyawan/tambah" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;"><span class="btn-icon-left text-success">
                <i class="fa fa-plus color-info"></i> </span>Tambah Data</a>

                <!-- Button trigger modal -->
                <a href="#" class="btn btn-rounded btn-success" style="margin-bottom: 20px; background-color: #558b2f;" data-toggle="modal" data-target="#basicModal"><span class="btn-icon-left text-success">
                    <i class="fa fa-file-excel-o color-info"></i> </span>Import Data</a>

                <!-- Modal -->
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Import Data</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/karyawan/add/import" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <input type="file" class="form-control" name="import_data">
                                    <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">Kembali</button>
                                    <input type="submit" class="btn btn-success mt-5" value="Import Data">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                  <table class="example-style display" style="min-width: 845px; color: black;">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Karyawan</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($karyawan as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->karyawan }}</td>
                            <td>
                                <a href="/karyawan/edit/{{ $item->id }}" class="btn btn-warning btn-xs">Edit</a>
                                <a href="/karyawan/delete/{{ $item->id }}" class="btn btn-danger btn-xs">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Aksi</th>
                      </tr>
                  </tfoot>
              </table>
              </div>
          </div>
      </div>
  </div>
@endsection
