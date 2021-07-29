@extends('templates.index')

@section('title', 'ekopz | profile')

@section('content-title')
<div class="col p-0">
    <h4>profile</h4>
    {{-- <h4>Hello {{Auth::user()->name}}, <span>Welcome here</span></h4> --}}
</div>
<div class="col p-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a>
        </li>
        <li class="breadcrumb-item active text-success">Profile Koperasi</li>
    </ol>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <div class="photo-content">
                        @if (!$koperasi->banner && $koperasi->banner == null)
                        <div class="cover-photo"></div>
                        @else
                            <div class="cover-photo" style="background-image: url({{ $koperasi->banner }})"></div>
                        @endif
                        <div class="profile-photo">
                            @if (!$koperasi->foto && $koperasi->foto == null)
                                <img src="{{ asset('assets/images/profile/profile.png') }}" class="img-fluid rounded-circle" alt="">  
                            @else
                                <img src="{{ $koperasi->foto }}" style="height: 150px; object-fit: cover;" class="img-fluid rounded-circle" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 border-right-1">
                                        <div class="profile-name">
                                            <h4 class="text-success">{{ $koperasi->nama }}</h4>
                                            <p>Nama Koperasi</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 border-right-1">
                                        <div class="profile-email">
                                            <h4 class="text-muted">{{ Session::get('email') }}</h4>
                                            <p>Email</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4 border-right-1">
                                        <div class="profile-call">
                                            <h4 class="text-success">{{ $koperasi->jenis_koperasi != null ? $koperasi->jenis_koperasi : $notfound }}</h4>
                                            <p>Jenis Koperasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="profile-statistics">
                        <div class="text-center mt-4 border-bottom-1 pb-3">
                            <div class="row">
                                <div class="col">
                                    <h3 class="m-b-0">150</h3><span>Produk</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">4.0</h3><span>Rating</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success pl-5 pr-5 mr-3 mb-4" data-toggle="modal" data-target="#basicModal">Update Foto</button>

                                <!-- Modal -->
                                <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload foto</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/profile/upload" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" class="form-control" name="upload_foto">
                                                    <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">Kembali</button>
                                                    <input type="submit" class="btn btn-success mt-5" value="upload foto">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning pl-5 pr-5 mr-3 mb-4" data-toggle="modal" data-target="#bannerModal">Update Banner</button>

                                <!-- Modal -->
                                <div class="modal fade" id="bannerModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload Banner</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/profile/upload/banner" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" class="form-control" name="upload_banner">
                                                    <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">Kembali</button>
                                                    <input type="submit" class="btn btn-success mt-5" value="upload foto">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-blog pt-3 border-bottom-1 pb-1">
                        <h5 class="text-success d-inline">News eKopz</h5><a href="javascript:void()" class="pull-right f-s-16">More</a> 
                        <img src="../../assets/images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                        <h4>Darwin Creative Agency Theme</h4>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">Profile Koperasi</a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Update Data Koperasi</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="profile-personal-info border-bottom-1 pt-5">
                                        <h4 class="text-success mb-4">Informasi Koperasi</h4>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Nama Koperasi <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ $koperasi->nama != null ? $koperasi->nama : $notfound }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Badan Hukum <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ $koperasi->badanHukum != null ? $koperasi->badanHukum : $notfound }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Tahun Berdiri<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ $koperasi->thnBerdiri != null ? $koperasi->thnBerdiri : $notfound }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Jam Buka<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ $koperasi->jam_buka != null ? $koperasi->jam_buka : $notfound }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Jam Tutup<span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{ $koperasi->jam_tutup != null ? $koperasi->jam_tutup : $notfound }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-kategori pt-5 border-bottom-1 pb-5">
                                        <h4 class="text-success mb-4">Jenis Koperasi</h4>
                                        @if ($koperasi->jenis_koperasi != null)
                                            <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">{{ $koperasi->jenis_koperasi }}</a>
                                        @else
                                            {{ $notfound }}
                                        @endif
                                        
                                    </div>
                                    <div class="profile-description border-bottom-1 pt-5">
                                        <h4 class="text-success mb-4">Alamat Koperasi</h4>
                                        <div class="row mb-4 ml-1">
                                            {{ $koperasi->alamat != null ? $koperasi->alamat : $notfound }}
                                        </div>
                                    </div>
                                    <div class="profile-description border-bottom-1 pt-5">
                                        <h4 class="text-success mb-4">Deskripsi Koperasi</h4>
                                        <div class="row mb-4 ml-1">
                                            {{ $koperasi->deskripsi != null ? $koperasi->deskripsi : $notfound }}
                                        </div>
                                    </div>
                                    <div class="border-bottom-1 pt-5">
                                        <h4 class="text-success mb-4">Syarat Koperasi</h4>
                                        <div class="mb-4 ml-1">
                                            {!! $koperasi->syarat != null ? $koperasi->syarat : $notfound !!}
                                        </div>
                                    </div>
                                    <div class="border-bottom-1 pt-5">
                                        <h4 class="text-success mb-4">Syarat Pinjaman</h4>
                                        <div class="mb-4 ml-1">
                                            {!! $koperasi->syarat_pinjaman != null ? $koperasi->syarat_pinjaman : $notfound !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <form action="/profile/update" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Nama Koperasi</label>
                                                    <input type="text" name="nama" value="{{ $koperasi->nama != null ? $koperasi->nama : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Koperasi</label>
                                                    <select name="jenis_koperasi" class="form-control">
                                                        <option @if ($koperasi->jenis_koperasi || $koperasi->jenis_koperasi == "serba usaha") selected @endif value="serba usaha">Serba Usaha</option>
                                                        <option @if ($koperasi->jenis_koperasi || $koperasi->jenis_koperasi == "simpan pinjam") selected @endif value="simpan pinjam">Simpan Pinjam</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Toko</label>
                                                    <input type="text" name="alamat" value="{{ $koperasi->alamat != null ? $koperasi->alamat : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tahun Berdiri</label>
                                                    <input type="text" name="thnBerdiri" value="{{ $koperasi->thnBerdiri != null ? $koperasi->thnBerdiri : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Badan Hukum</label>
                                                    <input type="text" name="badanHukum" value="{{ $koperasi->badanHukum != null ? $koperasi->badanHukum : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi Koperasi</label>
                                                    <input type="text" name="deskripsi" value="{{ $koperasi->deskripsi != null ? $koperasi->deskripsi : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jam Buka</label>
                                                    <input type="text" name="jam_buka" value="{{ $koperasi->jam_buka != null ? $koperasi->jam_buka : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jam Tutup</label>
                                                    <input type="text" name="jam_tutup" value="{{ $koperasi->jam_tutup != null ? $koperasi->jam_tutup : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Warna Koperasi</label>
                                                    <input type="color" name="warna" value="{{ $koperasi->warna != null ? $koperasi->warna : null }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-label">Syarat Koperasi</label>
                                                    <textarea class="ckeditor" name="syarat" id="ck_edtor">{!! $koperasi->syarat !!}</textarea>
                              
                                                    @if($errors->has('syarat'))
                                                      <div class="text-danger">
                                                        {{ $errors->first('syarat') }}
                                                      </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-label">Syarat Pinjaman</label>
                                                    <textarea class="ckeditor" name="syarat_pinjaman" id="ck_edtor">{!! $koperasi->syarat_pinjaman !!}</textarea>
                              
                                                    @if($errors->has('syarat_pinjaman'))
                                                      <div class="text-danger">
                                                        {{ $errors->first('syarat_pinjaman') }}
                                                      </div>
                                                    @endif
                                                </div>
                                                
                                                <input type="submit" class="btn btn-success" value="Update Data">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection