@extends('templates.index')

@section('title', 'ekopz | pinjaman')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Angsuran pinjaman</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">pinjaman</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Angsuran pinjaman</li>
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
            <h4 class="card-title mb-4">Form Angsuran pinjaman</h4>
            <div class="basic-form">
                <form action="/pinjaman/angsuran/add" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="text-label">Pinjaman</label>
                        <select name="id_pinjaman" id="id_pinjaman" class="js-example-placeholder-multiple form-control">
                          @foreach ($pinjaman as $item)
                            <option value="{{ $item->id }}">{{ $item->anggota->nama }} (angsuran ke-{{ $item->angsuran + 1 }}) - Rp. {{ number_format($item->jumlah_pinjaman / $item->jumlah_cicilan + $item->jumlah_pinjaman * $item->jumlah_cicilan/100 / $item->jumlah_cicilan,0,',','.') }}</option>
                          @endforeach
                        </select>
                      </div>
                      
                  <button type="submit" class="btn btn-success btn-form mr-2">Tambah Angsuran</button>
                  <a href="/pinjaman" class="btn btn-success btn-form mr-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
