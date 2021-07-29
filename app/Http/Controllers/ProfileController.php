<?php

namespace App\Http\Controllers;

use App\model\Koperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\ImageUpload;
use Illuminate\Support\Facades\Http;

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

        $koperasi->syarat_pinjaman = $request->syarat_pinjaman;

        $koperasi->warna = $request->warna;

        $koperasi->save();

        return redirect('/profile')->with('success', 'data berhasil di update !');
    } 

    public function uploadFoto(Request $request)
    {
        $this->validate($request, [
            'upload_foto' => 'required',
        ], [
            'required' => 'form :attribute tidak boleh kosong!'
        ]);
        
        $url = "https://api.ekopz.id/api/foto/koperasi/".Session::get('id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('token')
        ])->attach('foto', fopen($request->upload_foto, 'r'))
        ->post($url);
        
        $koperasi = Koperasi::where('id_users', Session::get('id'))->first();
        
        Session::put('foto', $koperasi->foto);

        return redirect('/profile')->with('status', 'upload toko berhasil !');
    }

    public function uploadBanner(Request $request)
    {
        $this->validate($request, [
            'upload_banner' => 'required',
        ], [
            'required' => 'form :attribute tidak boleh kosong!'
        ]);
        
        $url = "https://api.ekopz.id/api/foto/koperasi/banner/".Session::get('id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('token')
        ])->attach('banner', fopen($request->upload_banner, 'r'))
        ->post($url);
        
        $koperasi = Koperasi::where('id_users', Session::get('id'))->first();
        
        Session::put('banner', $koperasi->banner);

        return redirect('/profile')->with('status', 'upload toko berhasil !');
    }
}
