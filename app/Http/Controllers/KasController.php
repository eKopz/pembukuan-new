<?php

namespace App\Http\Controllers;

use App\Exports\KasExport;
use App\model\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class KasController extends Controller
{
    public function export(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required',
            'mulai' => 'required', 
            'selesai' => 'required',
        ]);

        return Excel::download(new KasExport($request->tahun, $request->mulai, $request->selesai), 'kas.xlsx');
    }

    public function index()
    {
        $kas = Kas::where('id_koperasi', Session::get('id_koperasi'))->get();

        $kas_masuk =  Kas::select(DB::raw('sum(jumlah) as saldo'))->where('id_koperasi', Session::get('id_koperasi'))->where('no_bukti', 'like', 'KM%')->first();

        $kas_keluar =  Kas::select(DB::raw('sum(jumlah) as saldo'))->where('id_koperasi', Session::get('id_koperasi'))->where('no_bukti', 'like', 'KK%')->first();

        return view('kas.index', compact('kas', 'kas_masuk', 'kas_keluar'));
    }

    public function kasMasuk()
    {
        $kas = Kas::where('id_koperasi', Session::get('id_koperasi'))->where('jenis_kas', 1)->get();

        $kas_masuk =  Kas::select(DB::raw('sum(jumlah) as saldo'))->where('id_koperasi', Session::get('id_koperasi'))->where('no_bukti', 'like', 'KM%')->first();

        return view('kas.masuk', compact('kas','kas_masuk'));
    }

    public function kasKeluar()
    {
        $kas = Kas::where('id_koperasi', Session::get('id_koperasi'))->where('jenis_kas', 2)->get();

        $kas_keluar =  Kas::select(DB::raw('sum(jumlah) as saldo'))->where('id_koperasi', Session::get('id_koperasi'))->where('no_bukti', 'like', 'KK%')->first();

        return view('kas.keluar', compact('kas', 'kas_keluar'));
    }

    public function formTambah()
    {
        return view('kas.tambah');
    }

    public function formEdit($id)
    {
        $kas = Kas::find($id);

        return view('kas.edit', compact('kas'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh tipe number !',
        ];

        $this->validate($request, [
            'uraian' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        if ($request->jenis_kas == 1) {
            $kas = Kas::select(DB::raw('count(no_bukti) as bukti'))->where('no_bukti', 'like', 'KM%')->where('id_koperasi', Session::get('id_koperasi'))->first();
            $bukti = 'KM'.($kas->bukti + 1);

            Kas::create([
                'no_bukti' => $bukti,
                'uraian' => $request->uraian,
                'jenis_kas' => $request->jenis_kas,
                'jumlah' => $request->jumlah,
                'id_koperasi' => Session::get('id_koperasi'),
            ]);
        }
        else {
            $kas = Kas::select(DB::raw('count(no_bukti) as bukti'))->where('no_bukti', 'like', 'KK%')->where('id_koperasi', Session::get('id_koperasi'))->first();
            $bukti = 'KK'.($kas->bukti + 1);

            Kas::create([
                'no_bukti' => $bukti,
                'uraian' => $request->uraian,
                'jenis_kas' => $request->jenis_kas,
                'jumlah' => $request->jumlah,
                'id_koperasi' => Session::get('id_koperasi'),
            ]);
        }

        return redirect('/kas')->with('alert-success', 'Berhasil Tambah Data');
    }

    public function update($id, Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh tipe number !',
        ];

        $this->validate($request, [
            'uraian' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $kas = Kas::find($id);

        $kas->uraian = $request->uraian;

        $kas->jenis_kas = $request->jenis_kas;

        $kas->jumlah = $request->jumlah;

        if ($request->jenis_kas == 1) {
            $kas_masuk = Kas::select(DB::raw('count(no_bukti) as bukti'))->where('no_bukti', 'like', 'KM%')->where('id_koperasi', Session::get('id_koperasi'))->first();
            $bukti = 'KM'.($kas_masuk->bukti + 1);

            $kas->no_bukti = $bukti;
        }
        else {
            $kas_keluar = Kas::select(DB::raw('count(no_bukti) as bukti'))->where('no_bukti', 'like', 'KK%')->where('id_koperasi', Session::get('id_koperasi'))->first();
            $bukti = 'KK'.($kas_keluar->bukti + 1);

            $kas->no_bukti = $bukti;
        }

        $kas->save();

        return redirect('/kas')->with('alert-success', 'Berhasil Update Data');   
    }

    public function delete($id)
    {
        $kas = Kas::find($id);

        $kas->delete();

        return redirect('/kas')->with('alert-success', 'Berhasil Delete Data');
    }
}
