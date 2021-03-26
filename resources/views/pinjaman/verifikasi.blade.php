@extends('templates.index')

@section('title', 'ekopz | verifikasi pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">verifikasi pinjaman</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">verifikasi pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Form verifikasi pinjaman</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="card-content">
  <?php if (session('alert-danger')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button> {{ session('alert-danger') }}
    </div>
  <?php endif; ?>
</div>
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form verifikasi pengajuan pinjaman</h4>
            <div class="basic-form">
                <form action="/pinjaman/verifikasi/add/{{ $pinjaman->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">verifikasi</label>
                      <select name="verifikasi" class="js-example-placeholder-multiple form-control">  
                        <option value="1">setuju</option>
                        <option value="2">tolak</option>
                      </select>
                    </div>

                  <button type="submit" class="btn btn-success btn-form mr-2">Verifikasi</button>
                  <a href="/pinjaman/pengajuan" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
