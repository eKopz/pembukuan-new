<?php

namespace App\Http\Controllers;

use App\model\Koperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\ImageUpload;

class ProfileController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $koperasi = Koperasi::find(Session::get('id_koperasi'));
        $notfound = "Tidak Diketahui";

        return view('profile.index', compact('koperasi', 'notfound'));
    }

    public function update(Request $request)
    {
        $koperasi = Koperasi::where('id_users', Session::get('id'))->first();

        $koperasi->nama = $request->nama;
        
        $koperasi->jenis_koperasi = $request->jenis_koperasi;

        $koperasi->badanHukum = $request->badanHukum;

        $koperasi->alamat = $request->alamat;

        $koperasi->thnBerdiri = $request->thnBerdiri;

        $koperasi->deskripsi = $request->deskripsi;

        $koperasi->jam_buka = $request->jam_buka;

        $koperasi->jam_tutup = $request->jam_tutup;

        $koperasi->syarat = $request->syarat;

        $koperasi->save();

        return redirect('/profile')->with('success', 'data berhasil di update !');
    } 

    public function uploadFoto(Request $request)
    {
        $koperasi = Koperasi::where('id_users', Session::get('id'))->first();

        $this->validate($request, [
            'upload_foto' => 'required'
        ], [
            'required' => 'form :attribute tidak boleh kosong!'
        ]);

        //upload image
        $foto = $request->upload_foto;
        $urlFoto = $foto != null ?
            $this->storeImages($foto, 'koperasi') : $koperasi->foto;

        $koperasi->foto = $urlFoto;

        $koperasi->save();

        Session::put('foto', $urlFoto);

        return redirect('/profile')->with('status', 'upload toko berhasil !');
    }
}
