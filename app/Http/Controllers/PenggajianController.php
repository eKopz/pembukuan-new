<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ImageUpload;
use App\model\Gaji;
use App\model\KaryawanKoperasi;
use App\model\Pinjaman;
use App\model\PotongGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenggajianController extends Controller
{
    use ImageUpload;

    public function index()
    {
        $gaji = Gaji::where('id_koperasi', Session::get('id_koperasi'))->orderBy('id', 'DESC')->get();

        return view('penggajian.index', compact('gaji'));
    }

    public function formTambah()
    {
        $karyawan = KaryawanKoperasi::where('id_koperasi', Session::get('id_koperasi'))->get();

        return view('penggajian.tambah', compact('karyawan'));
    }

    public function formEdit($id)
    {
        $gaji = Gaji::find($id);

        return view('penggajian.edit', compact('gaji'));
    }

    public function formEditPotonganGaji($id)
    {
        $gaji = Gaji::find($id);

        return view('penggajian.edit_potongan_gaji', compact('gaji'));
    }

    public function formEditBuktiBayar($id)
    {
        $gaji = Gaji::find($id);

        return view('penggajian.upload_bukti', compact('gaji'));
    }

    public function detail($id)
    {
        $gaji = Gaji::find($id);

        $get_sub_total = $gaji->karyawan_koperasi->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->rapel + $gaji->jamsostek;

        $sub_total_tahun = $get_sub_total * 12;
        
        if ($sub_total_tahun > $gaji->karyawan_koperasi->pajak->total_gaji) {
            $pajak = $sub_total_tahun - $gaji->karyawan_koperasi->pajak->total_gaji;

            $pph_tahun = $pajak * 0.05;

            $pph = $pph_tahun / 12;
        } else {
            $pph = 0;
        }

        return view('penggajian.detail', compact('gaji', 'pph'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh number !',
        ];

        $this->validate($request, [
            'potongan_simpanan' => 'numeric',
            'potongan_simpanan_pokok' => 'numeric', 
            'potongan_simpanan_wajib' => 'numeric',
            'mangkir' => 'required|numeric',
        ], $message);

        $karyawan = KaryawanKoperasi::find($request->id_karyawan_koperasi);

        $get_sub_total = $request->gaji_pokok + $request->makan + $request->transport + $request->insentif + $request->rapel + $request->jamsostek;

        $jumlah_potongan = $request->potongan_simpanan + $request->potongan_simpanan_wajib + $request->potongan_simpanan_pokok + $request->potongan_pinjaman + $request->mangkir + $request->jamsostek;  

        $total = $get_sub_total - $jumlah_potongan;

        Gaji::create([
            'id_karyawan_koperasi' => $request->id_karyawan_koperasi,
            'makan' => $request->makan,
            'transport' => $request->transport,
            'insentif' => $request->insentif,
            'rapel' => $request->rapel,
            'jamsostek' => $request->jamsostek,
            'status' => 1,
            'id_koperasi' => Session::get('id_koperasi'), 
            'mangkir' => $request->mangkir,
            'potongan_simpanan' => $request->potongan_simpanan,
            'potongan_simpanan_pokok' => $request->potongan_simpanan_pokok,
            'potongan_simpanan_wajib' => $request->potongan_simpanan_wajib,
            'potongan_pinjaman' => $request->potongan_pinjaman,
            'total_gaji' => $total,
            'metode' => null,
            'bukti' => null,
            'keterangan' => null,
        ]);

        return redirect('/gaji')->with('alert-success', 'berhasil tambah data gaji !');
    }

    public function formTambahPotonganGaji(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh number !',
        ];

        $this->validate($request, [
            'makan' => 'required|numeric', 
            'transport' => 'required|numeric', 
            'insentif' => 'required|numeric', 
            'rapel' => 'required|numeric', 
            'jamsostek' => 'required|numeric',
        ], $message);

        $makan = $request->makan * 12500;

        $transport = $request->transport * 12500;

        $insentif = $request->insentif;

        $rapel = $request->rapel;

        $jamsostek = $request->jamsostek;

        $karyawan = KaryawanKoperasi::join('potong_gaji', 'karyawan_koperasi.potong_gaji', 'potong_gaji.id')
            ->select('karyawan_koperasi.*', 'potong_gaji.simpanan as simpanan', 'potong_gaji.simpanan_pokok as simpanan_pokok', 'potong_gaji.simpanan_wajib as simpanan_wajib', 'potong_gaji.pinjaman as pinjaman')
            ->where('karyawan_koperasi.id', $request->id_karyawan_koperasi)
            ->first();

        $get_sub_total = $karyawan->gaji_pokok + $makan + $transport + $insentif + $rapel + $jamsostek;

        $sub_total_tahun = $get_sub_total * 12;
        
        if ($sub_total_tahun > $karyawan->pajak->total_gaji) {
            $pajak = $sub_total_tahun - $karyawan->pajak->total_gaji;

            $pph_tahun = $pajak * 0.05;

            $pph = $pph_tahun / 12;
        } else {
            $pph = 0;
        }

        $potong_gaji = PotongGaji::find($karyawan->potong_gaji);

        if ($potong_gaji->pinjaman == 1) {
            $pinjaman  = Pinjaman::where('id_anggota', $karyawan->id_anggota)->where('status', 2)->first();

            $jumlah_pinjaman = $pinjaman->jumlah_pinjaman / $pinjaman->jumlah_cicilan;
        } else {
            $jumlah_pinjaman = 0;
        }

        return view('penggajian.tambah2', compact('makan', 'transport', 'insentif', 'rapel', 'jamsostek', 'karyawan', 'pph', 'jumlah_pinjaman', 'get_sub_total'));
    }

    public function updateBuktiBayar(Request $request, $id)
    {
        $this->validate($request, [
            'bukti' => 'mimes:jpeg,jpg,png,gif|required|max:2048',
        ]);

        $gaji = Gaji::find($id);

        $urlBukti = $request->bukti != null ?
            $this->storeImages($request->bukti, 'bukti_bayar_gaji') : null;

        $gaji->metode = $request->metode;

        $gaji->bukti = $urlBukti;

        $gaji->keterangan = $request->keterangan;

        $gaji->status = 2;

        $gaji->save();

        return redirect('/gaji')->with('alert-success', 'berhasil upload bukti pembayaran gaji !');
    }

    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh number !',
        ];

        $this->validate($request, [
            'makan' => 'required|numeric', 
            'transport' => 'required|numeric', 
            'insentif' => 'required|numeric', 
            'rapel' => 'required|numeric', 
            'jamsostek' => 'required|numeric',
        ], $message);

        $gaji = Gaji::find($id);

        $sub_total_gaji = $gaji->gaji_pokok + $request->makan + $request->transport + $request->insentif + $request->rapel + $request->jamsostek;

        $sub_total_tahun = $sub_total_gaji * 12;
        
        if ($sub_total_tahun > $gaji->karyawan_koperasi->pajak->total_gaji) {
            $pajak = $sub_total_tahun - $gaji->karyawan_koperasi->pajak->total_gaji;

            $pph_tahun = $pajak * 0.05;

            $pph = $pph_tahun / 12;
        } else {
            $pph = 0;
        }

        $potong_gaji = PotongGaji::find($gaji->karyawan_koperasi->potong_gaji);

        if ($potong_gaji->pinjaman == 1) {
            $pinjaman  = Pinjaman::where('id_anggota', $gaji->karyawan_koperasi->id_anggota)->where('status', 2)->first();

            $jumlah_pinjaman = $pinjaman->jumlah_pinjaman / $pinjaman->jumlah_cicilan;
        } else {
            $jumlah_pinjaman = 0;
        }

        $total_gaji = $sub_total_gaji - ($gaji->potongan_simpanan + $gaji->potongan_simpanan_pokok + $gaji->potongan_simpanan_wajib + $gaji->mangkir + $jumlah_pinjaman + $pph);

        //update

        $gaji->makan = $request->makan;

        $gaji->transport = $request->transport;

        $gaji->insentif = $request->insentif;

        $gaji->rapel = $request->rapel;

        $gaji->jamsostek = $request->jamsostek;

        $gaji->status = $request->status;

        $gaji->total_gaji = $total_gaji;

        $gaji->save();

        return redirect('/gaji')->with('alert-success', 'berhasil update data !');
    }

    public function updatePotonganGaji(Request $request, $id)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh number !',
        ];

        $this->validate($request, [
            'potongan_simpanan' => 'numeric',
            'potongan_simpanan_pokok' => 'numeric', 
            'potongan_simpanan_wajib' => 'numeric',
            'mangkir' => 'required|numeric',
        ], $message);

        $gaji = Gaji::find($id);

        $sub_total_gaji = $gaji->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->rapel + $gaji->jamsostek;

        $sub_total_tahun = $sub_total_gaji * 12;
        
        if ($sub_total_tahun > $gaji->karyawan_koperasi->pajak->total_gaji) {
            $pajak = $sub_total_tahun - $gaji->karyawan_koperasi->pajak->total_gaji;

            $pph_tahun = $pajak * 0.05;

            $pph = $pph_tahun / 12;
        } else {
            $pph = 0;
        }

        $potong_gaji = PotongGaji::find($gaji->karyawan_koperasi->potong_gaji);

        if ($potong_gaji->pinjaman == 1) {
            $pinjaman  = Pinjaman::where('id_anggota', $gaji->karyawan_koperasi->id_anggota)->where('status', 2)->first();

            $jumlah_pinjaman = $pinjaman->jumlah_pinjaman / $pinjaman->jumlah_cicilan;
        } else {
            $jumlah_pinjaman = 0;
        }

        $total_gaji = $sub_total_gaji - ($request->potongan_simpanan + $request->potongan_simpanan_pokok + $request->potongan_simpanan_wajib + $request->mangkir + $jumlah_pinjaman + $pph);

        $gaji->simpanan = $request->simpanan;

        $gaji->simpanan_pokok = $request->simpanan_pokok;

        $gaji->simpanan_wajib = $request->simpanan_wajib;

        $gaji->mangkir = $request->mangkir;

        $gaji->total_gaji = $total_gaji;

        $gaji->save();

        return redirect('/gaji')->with('alert-success', 'berhasil update potongan gaji !');
    }
}
