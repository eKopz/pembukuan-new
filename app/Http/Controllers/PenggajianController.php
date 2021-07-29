<?php

namespace App\Http\Controllers;

use App\Exports\PenggajianExport;
use App\Http\Controllers\Traits\ImageUpload;
use App\model\Anggota;
use App\model\AngsuranPinjaman;
use App\model\Gaji;
use App\model\KaryawanKoperasi;
use App\model\Pinjaman;
use App\model\PotongGaji;
use App\model\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PenggajianController extends Controller
{
    use ImageUpload;

    public function export(Request $request)
    {
        $this->validate($request, [
            'year' => 'required',
            'month' => 'required'
        ]);

        return Excel::download(new PenggajianExport($request->month, $request->year), 'Gaji.xlsx');
    }

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

        $get_sub_total = $gaji->karyawan_koperasi->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->lembur + $gaji->rapel + $gaji->jamsostek;

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

        $get_sub_total = $request->gaji_pokok + $request->makan + $request->transport + $request->insentif  + $request->lembur + $request->rapel + $request->jamsostek;

        $jumlah_potongan = $request->potongan_simpanan + $request->potongan_simpanan_wajib + $request->potongan_simpanan_pokok + $request->potongan_pinjaman + $request->mangkir + $request->jamsostek;  

        $total = $get_sub_total - $jumlah_potongan;

        $gaji = Gaji::create([
            'id_karyawan_koperasi' => $request->id_karyawan_koperasi,
            'makan' => $request->makan,
            'transport' => $request->transport,
            'insentif' => $request->insentif,
            'rapel' => $request->rapel,
            'lembur' => $request->lembur,
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

        $anggota = Anggota::find($karyawan->id_anggota);

        if ($anggota != null) {
            //potongan pinjaman

            if ($request->potongan_pinjaman > 0) {
                $pinjaman = Pinjaman::where('id_angoota', $karyawan->anggota->id)->where('status', 2)->first();
                
                $jasa = $request->potongan_pinjaman * 1/100;
    
                $jumlah_angsuran = $request->potongan_pinjaman + $jasa;
                
                $angsuran_pinjaman = AngsuranPinjaman::create([
                    'id_pinjaman' => $pinjaman->id,
                    'jumlah' => $jumlah_angsuran,
                    'saldo' => 0,
                    'angsuran' => 0,
                ]);
                
                $cicilan = 1;
    
                $anggota->pinjaman -= $request->potongan_pinjaman; 
    
                $anggota->save();
    
                $pinjaman->angsuran += $cicilan;
    
                $pinjaman->save();
    
                $angsuran_pinjaman->saldo = $anggota->pinjaman;
    
                $angsuran_pinjaman->angsuran += $pinjaman->angsuran;
    
                $angsuran_pinjaman->save();
            }

            //potongan simpanan
    
            $anggota->simpanan += $request->potongan_simpanan;
            $anggota->simpanan_wajib += $request->potongan_simpanan_wajib;
            $anggota->simpanan_pokok += $request->potongan_simpanan_pokok;
            $anggota->save();

            if ($request->potongan_simpanan > 0) {
                Simpanan::create([
                    'id_koperasi' => Session::get('id_koperasi'),
                    'id_anggota' => $anggota->id,
                    'id_jenis_simpanan' => 1,
                    'jumlah' => $request->potongan_simpanan,
                    'status' => 1,
                    'saldo' => $anggota->simpanan,
                ]);               
            }
            if ($request->potongan_simpanan_pokok > 0) {
                Simpanan::create([
                    'id_koperasi' => Session::get('id_koperasi'),
                    'id_anggota' => $anggota->id,
                    'id_jenis_simpanan' => 2,
                    'jumlah' => $request->potongan_simpanan_pokok,
                    'status' => 1,
                    'saldo' => $anggota->simpanan_pokok,
                ]); 
            }
            if ($request->potongan_simpanan_wajib > 0) {
                Simpanan::create([
                    'id_koperasi' => Session::get('id_koperasi'),
                    'id_anggota' => $anggota->id,
                    'id_jenis_simpanan' => 3,
                    'jumlah' => $request->potongan_simpanan_wajib,
                    'status' => 1,
                    'saldo' => $anggota->simpanan_wajib,
                ]); 
            }
        }

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

        $makan = $request->makan;

        $transport = $request->transport;

        $insentif = $request->insentif;

        $rapel = $request->rapel;

        $jamsostek = $request->jamsostek;

        $lembur = $request->lembur;

        $karyawan = KaryawanKoperasi::join('potong_gaji', 'karyawan_koperasi.potong_gaji', 'potong_gaji.id')
            ->select('karyawan_koperasi.*', 'potong_gaji.simpanan as simpanan', 'potong_gaji.simpanan_pokok as simpanan_pokok', 'potong_gaji.simpanan_wajib as simpanan_wajib', 'potong_gaji.pinjaman as pinjaman')
            ->where('karyawan_koperasi.id', $request->id_karyawan_koperasi)
            ->first();

        $get_sub_total = $karyawan->gaji_pokok + $makan + $transport + $insentif + $rapel + $lembur + $jamsostek;

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

        return view('penggajian.tambah2', compact('makan', 'transport', 'insentif', 'rapel', 'lembur', 'jamsostek', 'karyawan', 'pph', 'jumlah_pinjaman', 'get_sub_total'));
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
            'lembur' => 'required|numeric',
            'jamsostek' => 'required|numeric',
        ], $message);

        $gaji = Gaji::find($id);

        $sub_total_gaji = $gaji->gaji_pokok + $request->makan + $request->transport + $request->insentif + $request->rapel + $request->lembur + $request->jamsostek;

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

        $gaji->lembur = $request->lembur;

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

        $sub_total_gaji = $gaji->gaji_pokok + $gaji->makan + $gaji->transport + $gaji->insentif + $gaji->rapel + $gaji->lembur + $gaji->jamsostek;

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
