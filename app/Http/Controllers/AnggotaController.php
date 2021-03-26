<?php

namespace App\Http\Controllers;

use App\model\Anggota;
use App\model\Karyawan;
use App\model\Koperasi;
use App\model\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->orderBy('id', 'desc')->get();

        return view('anggota.index', compact('anggota'));   
    }

    public function detail($id)
    {
        $anggota = Anggota::find($id);

        $pengguna = Anggota::
                   join('pengguna', 'anggota.id_pengguna', '=', 'pengguna.id') 
                   ->join('users', 'pengguna.id_users', '=', 'users.id')
                   ->join('alamat', 'users.id', '=', 'alamat.id_users')
                   ->select('alamat.kota as kota')
                   ->where('anggota.id', $id)
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

        return view('anggota.detail', compact('anggota', 'alamat'));
    }

    public function formTambah()
    {
        $pengguna = Pengguna::all();

        $karyawan = Karyawan::all();

        return view('anggota.tambah', compact('pengguna', 'karyawan'));
    }

    public function formEdit($id)
    {
        $anggota = Anggota::find($id);

        $pengguna = Pengguna::all();

        $karyawan = Karyawan::all();

        return view('anggota.edit', compact('anggota', 'pengguna', 'karyawan'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !'
        ];

        $this->validate($request, [
            'no_anggota' => 'required'
        ], $message);

        Anggota::create([
            'no_anggota' => $request->no_anggota,
            'id_koperasi' => Session::get('id_koperasi'),
            'id_pengguna' => $request->pengguna,
            'simpanan' => 0,
            'simpanan_wajib' => 0,
            'simpanan_pokok' => 0,
            'pinjaman' => 0,
            'status' => 1,
            'id_karyawan' => $request->karyawan,
            'keterangan' => null,
        ]);

        return redirect('/anggota')->with('alert-success', 'berhasil tambah data');
    }

    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !'
        ];

        $this->validate($request, [
            'no_anggota' => 'required'
        ], $message);

        $anggota = Anggota::find($id);

        $anggota->no_anggota = $request->no_anggota;
        $anggota->id_karyawan = $request->karyawan;
        $anggota->keterangan = $request->keterangan;
        $anggota->status = $request->status;

        $anggota->save();

        return redirect('/anggota')->with('alert-success', 'berhasil update data');
    }

    public function nonaktif($id)
    {
        $anggota = Anggota::find($id);

        $anggota->status = 2;

        $anggota->save();

        return redirect('/anggota')->with('alert-success', 'Berhasil Non Aktif anggota');
    }
}
