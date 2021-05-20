@extends('templates.index')

@section('title', 'ekopz | Pengurus')

@section('content-title')
    <div class="col p-0">
        <h4 class="text-success">Detail Karyawan</h4>
    </div>
    <div class="col p-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengurus</a>
            </li>
            <li class="breadcrumb-item active text-success">Detail Karyawan</li>
        </ol>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="user-profile">
                                <h4 class="text-success section-heading card-intro-title">Data Karyawan</h4>
                                <div class="user-info">
                                    <ul>
                                        <li>
                                            <h5>Nama Karyawan</h5>
                                            <p>{{ $karyawan->anggota->nama }}</p>
                                        </li>
                                        <li>
                                            <h5>Loker</h5>
                                            <p>{{ $karyawan->loker }}</p>
                                        </li>
                                        <li class="mb-4">
                                            <h5>Jenis Kelamin</h5>
                                            @if ($karyawan->anggota->pengguna->jenis_kelamin == null)
                                                -
                                            @else
                                                <p>{{ $karyawan->anggota->pengguna->jenis_kelamin}}</p>
                                            @endif
                                        </li>
                                        <li class="mb-4">
                                            <h5>Status Kerja</h5>
                                            @if ($karyawan->status == 1)
                                                Tetap
                                            @elseif ($karyawan->status == 2)
                                                Kontrak
                                            @elseif ($karyawan->status == 3)
                                                Tenaga Lepas Harian (TLH)
                                            @else 
                                                Keluar 
                                            @endif
                                        </li>
                                        <li class="mb-4">
                                            <h5>Gaji Pokok</h5>
                                            <p>Rp. {{ number_format($karyawan->gaji_pokok,0,',','.') }}</p>
                                        </li>
                                        <li class="mb-4">
                                            <h5>Bank</h5>
                                            <p>{{ $karyawan->bank }}</p>
                                        </li>
                                        <li class="mb-4">
                                            <h5>No Rekening</h5>
                                            <p>{{ $karyawan->no_rekening }}</p>
                                        </li>
                                        <li class="mb-4">
                                            <h5>Pajak</h5>
                                            <p>{{ $karyawan->pajak->kode }}</p>
                                        </li>
                                        <li class="mb-4">
                                            <a href="/pengurus" class="btn btn-success">Kembali</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 my-5 my-lg-0">
            <div class="card card-full-width rounded-0">
                <div class="card-body user-details-contact text-center">
                    <div class="user-details-image mb-3">
                        <img class="rounded-circle" @if ($karyawan->anggota->pengguna->foto == null || $karyawan->anggota->pengguna->foto == "") src="{{ asset('assets/images/users/1.jpg') }}" @endif src="{{ $karyawan->anggota->pengguna->foto }}" alt="image">
                    </div>
                    <div class="user-intro">
                        <h4 class="text-primary card-intro-title mb-0">{{ $karyawan->anggota->nama }}</h4>
                        {{-- <p><small>@ Druid Wensleydale</small> --}}
                        </p>
                        @if ($karyawan->status == 4)
                            <p class="text-danger">Keluar</p>
                        @else
                            <p class="text-success">Karyawan Aktif</p>
                        @endif
                    </div>
                    <div class="contact-addresses">
                        <ul class="contact-address-list">
                            <li class="email">
                                <a href="/pengurus/karyawan/edit/{{ $karyawan->id }}" class="btn btn-warning mb-3">Edit</a>
                                <br>
                                @if ($karyawan->status == 4)
                                    <a href="/pengurus/karyawan/aktif/{{ $karyawan->id }}" data-toggle="modal" data-target="#karyawan_aktif" class="btn btn-success">Aktifkan Karyawan</a>
                                @else
                                    <a href="/pengurus/karyawan/nonaktif/{{ $karyawan->id }}" class="btn btn-danger">Non-Aktifkan Karyawan</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Aktifkan karyawan -->
    <div class="modal fade" id="karyawan_aktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Status Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pengurus/karyawan/aktif/{{ $karyawan->id }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="text-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Tetap</option>
                                <option value="2">Kontrak</option>
                                <option value="3">TLH</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-Warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Aktifkan Karyawan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
