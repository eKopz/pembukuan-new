<?php

namespace App\Http\Controllers;

use App\model\Anggota;
use App\model\KaryawanKoperasi;
use App\model\Koperasi;
use App\model\Pajak;
use App\model\PotongGaji;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KaryawanKoperasiController extends Controller
{
    public function detail($id)
    {
        $karyawan = KaryawanKoperasi::find($id);

        return view('pengurus.detail_karyawan', compact('karyawan'));
    }

    public function aktif(Request $request, $id)
    {
        $karyawan = KaryawanKoperasi::find($id);

        $karyawan->status = $request->status;

        $karyawan->save();

        return redirect()->back()->with('alert-success', 'berhasil mengaktifkan karyawan!');
    }

    public function nonaktif($id)
    {
        $karyawan = KaryawanKoperasi::find($id);

        $karyawan->status = 4;

        $karyawan->save();

        return redirect()->back()->with('alert-success', 'berhasil non-aktifkan karyawan!');
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

            $pajak = Pajak::all();

            return view('pengurus.tambah_karyawan', compact('anggota', 'pajak'));   
        }
    }

    public function formEdit($id)
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();

        $karyawan = KaryawanKoperasi::join('potong_gaji', 'karyawan_koperasi.potong_gaji', 'potong_gaji.id')
            ->join('pajak', 'karyawan_koperasi.id_pajak', 'pajak.id')
            ->select('karyawan_koperasi.*', 'potong_gaji.simpanan as simpanan', 'potong_gaji.simpanan_pokok as simpanan_pokok', 'potong_gaji.simpanan_wajib as simpanan_wajib', 'potong_gaji.pinjaman as pinjaman', 'pajak.total_gaji as jumlah_pajak')
            ->where('karyawan_koperasi.id', $id)
            ->first();

        $pajak = Pajak::all();

        return view('pengurus.edit_karyawan', compact('karyawan', 'pajak', 'anggota'));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'loker' => 'required|string',
            'gaji_pokok' => 'required|numeric', 
            'bank' => 'required|string', 
            'no_rekening' => 'required|numeric', 
        ]);

        if ($request->potong_gaji == 0) {
            $potong_gaji  = PotongGaji::create([
                'simpanan' => 0,
                'simpanan_pokok' => 0,  
                'simpanan_wajib' => 0,
                'pinjaman' => 0             
            ]);
        }
        else {
            $potong_gaji  = PotongGaji::create([
                'simpanan' => $request->simpanan,
                'simpanan_pokok' => $request->simpanan_pokok, 
                'simpanan_wajib' => $request->simpanan_wajib,
                'pinjaman' => $request->pinjaman
            ]);
        }

        KaryawanKoperasi::create([
            'id_anggota' => $request->id_anggota,
            'loker' => $request->loker, 
            'gaji_pokok' => $request->gaji_pokok, 
            'bank' => $request->bank,
            'no_rekening' => $request->no_rekening, 
            'id_pajak' => $request->id_pajak,
            'potong_gaji' => $potong_gaji->id,
            'status' => $request->status,
            'id_koperasi' => Session::get('id_koperasi'),
        ]);

        return redirect('/pengurus')->with('alert-success', 'berhasil tambah data karyawan!');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'loker' => 'required|string',
            'gaji_pokok' => 'required|numeric', 
            'bank' => 'required|string', 
            'no_rekening' => 'required|numeric', 
        ]);

        $karyawan = KaryawanKoperasi::find($id);

        $karyawan->loker = $request->loker;

        $karyawan->gaji_pokok = $request->gaji_pokok;

        $karyawan->bank = $request->bank;

        $karyawan->no_rekening = $request->no_rekening;

        $karyawan->id_pajak = $request->id_pajak;

        $karyawan->status = $request->status;

        $karyawan->save();

        $potong_gaji = PotongGaji::find($karyawan->potong_gaji);

        $potong_gaji->simpanan = $request->simpanan;

        $potong_gaji->simpanan_pokok = $request->simpanan_pokok;

        $potong_gaji->simpanan_wajib = $request->simpanan_wajib;

        $potong_gaji->pinjaman = $request->pinjaman;

        $potong_gaji->save();

        return redirect('/pengurus')->with('alert-success', 'berhasil update data karyawan! ');
    }

    public function ubahGajiPokok(Request $request, $id)
    {
        $this->validate($request, [
            'gaji_pokok' => 'required|numeric'
        ]);

        $karyawan = KaryawanKoperasi::find($id);

        $karyawan->gaji_pokok = $request->gaji_pokok;

        $karyawan->save();

        return redirect()->back()->with('alert-success', 'berhasil ubah gaji pokok !');
    }

    public function getKaryawanById($id)
    {
        $karyawan = KaryawanKoperasi::find($id);

        return json_encode($karyawan);
    }
}
