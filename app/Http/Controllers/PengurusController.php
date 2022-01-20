<?php

namespace App\Http\Controllers;

use App\model\Anggota;
use App\model\KaryawanKoperasi;
use App\model\Koperasi;
use App\model\Pengurus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->paginate(10);
        
        $karyawan = KaryawanKoperasi::where('id_koperasi', Session::get('id_koperasi'))->orderBy('id', 'DESC')->paginate(10);

        return view('pengurus.index', compact('pengurus', 'karyawan'));
    }

    public function detail($id)
    {
        $pengurus = Pengurus::find($id);

        $pengguna = Anggota::
                   join('pengguna', 'anggota.id_pengguna', '=', 'pengguna.id') 
                   ->join('users', 'pengguna.id_users', '=', 'users.id')
                   ->join('alamat', 'users.id', '=', 'alamat.id_users')
                   ->select('alamat.kota as kota')
                   ->where('anggota.id', $pengurus->id_anggota)
                   ->first();

        if ($pengguna == null) {
            $alamat = null;
        } else {
            $url = "https://pro.rajaongkir.com/api/city?id=$pengguna->kota";

            $api = Http::withHeaders([
                'key' => '712c2123c474afbc1f472f9e574c887a'
            ])->get($url);

            $body = json_decode($api->getBody(), true);

            $alamat = $body['rajaongkir']['results'];
        }


        return view('pengurus.detail', compact('pengurus', 'alamat'));
    }

    public function formTambah()
    {
        $user = User::find(Session::get('id'));

        $koperasi = Koperasi::where('id_users', $user->id)->first();

        if ($koperasi->badanHukum == null || $koperasi->thnBerdiri == null || $koperasi->deskripsi == null || $koperasi->jam_buka == null || $koperasi->jam_tutup == null || $koperasi->foto == null || $koperasi->banner == null || $koperasi->syarat == null || $koperasi->syarat_pinjaman == null || $koperasi->warna == null) {
            return redirect('/pengurus')->with('alert-danger', 'tidak bisa tambah data, isi profile koperasi terlebih dahulu!');
        }
        else {
            $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();

            return view('pengurus.tambah', compact('anggota'));
        }
    }

    public function formEdit($id)
    {
        $pengurus = Pengurus::find($id);

        return view('pengurus.edit', compact('pengurus'));
    }

    public function add(Request $request)
    {
        Pengurus::create([
            'id_anggota' => $request->id_anggota,
            'jabatan' => $request->jabatan,
            'status' => 1,
            'id_koperasi' => Session::get('id_koperasi'),
        ]);

        return redirect('/pengurus')->with('alert_success', 'berhasil tambah data !');
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::find($id);

        $pengurus->jabatan = $request->jabatan;

        $pengurus->status = $pengurus->status;

        $pengurus->save();

        return redirect('/pengurus')->with('alert_success', 'berhasil update data !');
    }
}