@extends('templates.index')

@section('title', 'ekopz | Anggota')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Edit Anggota</h4>
        {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Anggota</a>
            </li>
            <li class="breadcrumb-item active text-success">Form Edit Anggota</li>
        </ol>
    </div>
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card forms-card">
        <div class="card-body">
            <h4 class="card-title mb-4">Form Edit Anggota</h4>
            <div class="basic-form">
                <form action="/anggota/update/{{ $anggota->id }}" method="post" multiple="multiple" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label class="text-label">No anggota</label>
                      <input type="text" name="no_anggota" class="form-control" value="{{ $anggota->no_anggota }}">

                      @if($errors->has('no_anggota'))
                          <div class="text-danger">
                            {{ $errors->first('no_anggota') }}
                          </div>
                      @endif
                    </div>
                    
                    <div class="form-group">
                      <label class="text-label">Karyawan</label>
                      <select name="karyawan" class="js-example-placeholder-multiple form-control">
                        @foreach ($karyawan as $item)
                          <option @if ($anggota->karyawan->id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->karyawan }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="text-label">Keterangan</label>
                      
                      <input type="text" name="keterangan" class="form-control" value="{{ $anggota->keterangan }}">
                      
                      @if($errors->has('keterangan'))
                          <div class="text-danger">
                            {{ $errors->first('keterangan') }}
                          </div>
                      @endif
                    </div>

                    <div class="form-group">
                      <label class="text-label">status</label>
                      
                      <select name="status" class="js-example-placeholder-multiple form-control">
                        <option @if ($anggota->karyawan->id == 1) selected @endif value="1">Anggota</option>
                        <option @if ($anggota->karyawan->id == 0) selected @endif value="0">Keluar</option>
                      </select>
                    </div>
                  <button type="submit" class="btn btn-success btn-form mr-2">Update</button>
                  <a href="/anggota" class="btn btn-light text-dark btn-form">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
