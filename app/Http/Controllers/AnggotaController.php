<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use App\model\Anggota;
use App\model\Karyawan;
use App\model\Koperasi;
use App\model\Pengguna;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->whereNotIn('status', [2])->orderBy('status', 'asc')->orderBy('id', 'DESC')->get();

        return view('anggota.index', compact('anggota'));   
    }

    public function keluar()
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 2)->orderBy('status', 'asc')->orderBy('id', 'DESC')->get();

        return view('anggota.keluar', compact('anggota'));
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
        $user = User::find(Session::get('id'));

        $koperasi = Koperasi::where('id_users', $user->id)->first();

        if ($koperasi->badanHukum == null || $koperasi->thnBerdiri == null || $koperasi->deskripsi == null || $koperasi->jam_buka == null || $koperasi->jam_tutup == null || $koperasi->foto == null || $koperasi->banner == null || $koperasi->syarat == null || $koperasi->syarat_pinjaman == null || $koperasi->warna == null) {
            return redirect('/anggota')->with('alert-danger', 'tidak bisa tambah data, isi profile koperasi terlebih dahulu!');
        }
        else {
            $pengguna = Pengguna::all();

            $karyawan = Karyawan::all();

            return view('anggota.tambah', compact('pengguna', 'karyawan'));   
        }
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
            'no_anggota' => 'required', 
            'nama' => 'required'
        ], $message);
        
        Anggota::create([
            'nama' => $request->nama,
            'no_anggota' => $request->no_anggota,
            'id_koperasi' => Session::get('id_koperasi'),
            'id_pengguna' => null,
            'simpanan' => 0,
            'simpanan_wajib' => 0,
            'simpanan_pokok' => 0,
            'pinjaman' => 0,
            'status' => 4,
            'id_karyawan' => $request->karyawan,
            'keterangan' => null,
            'nik' => $request->nik,
        ]);

        return redirect('/anggota')->with('alert-success', 'berhasil tambah data');
    }

    public function importData(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !', 
            'mimes:csv,xls,xlsx' => ':attribute hanya boleh diisi oleh format file csv, xls, xlsx !'
        ];

        $this->validate($request, [
            'import_data' => 'required|mimes:csv,xls,xlsx'
        ], $message);

        $file = $request->file('import_data');

        $nama_file = rand()."-anggota-".$file->getClientOriginalName();

        $file->move('excel', $nama_file);

        Excel::import(new AnggotaImport, public_path('/excel/'. $nama_file));

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
        $anggota->nik = $request->nik;

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

    public function formVerifikasi($id)
    {
        $anggota = Anggota::find($id);

        $pengguna = Pengguna::find($anggota->id_pengguna);

        return view('anggota.verifikasi', compact('anggota', 'pengguna'));
    }

    public function verifikasi(Request $request, $id)
    {   
        $anggota = Anggota::find($id);

        if ($request->verifikasi == 1) {
            $anggota->status = 1;

            $anggota->is_active = 1;
        }
        else {
            $anggota->status = 4;

            $anggota->id_pengguna = null;
        }

        $anggota->save();

        return redirect('/anggota')->with('alert-success', 'berhasil verifikasi data');
    }
}
