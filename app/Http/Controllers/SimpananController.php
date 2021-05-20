<?php

namespace App\Http\Controllers;

use App\Exports\SimpananExport;
use App\Http\Controllers\Traits\ImageUpload;
use App\Imports\SimpananImport;
use App\model\Anggota;
use App\model\JenisSimpanan;
use App\model\PenarikanSimpanan;
use App\model\Simpanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class SimpananController extends Controller
{
    use ImageUpload;
    
    public function export()
    {
        return Excel::download(new SimpananExport, 'simpanan.xlsx');
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

        $nama_file = rand()."-simpanan-".$file->getClientOriginalName();

        $file->move('excel', $nama_file);

        Excel::import(new SimpananImport, public_path('/excel/'. $nama_file));

        return redirect('/simpanan')->with('alert-success', 'berhasil tambah data');
    }

    public function rekap()
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();

        return view('simpanan.rekap', compact('anggota'));
    }

    public function detail($id_anggota)
    {
        $anggota = Anggota::find($id_anggota);

        $tahun = Carbon::now()->year;

        $tahun_sebelumnya = $tahun-1;

        $start_month = new \DateTime("$tahun-01-01");
        $end_month = new \DateTime("$tahun-12-01");

        $end_month->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start_month, $interval, $end_month);
        $months = [];
        $simpanan = new \stdClass;

        foreach ($period as $dt) {
            setlocale(LC_ALL, 'IND');
            $month = strftime('%B', $dt->format('U'));

            array_push($months, $month);

            $simpanan->$month = Simpanan::select('id_jenis_simpanan', DB::raw('sum(jumlah) as jumlah'))
                                ->whereMonth('created_at', $dt->format('n'))
                                ->whereYear('created_at', $tahun)
                                ->where('id_koperasi', Session::get('id_koperasi'))
                                ->where('id_anggota', $id_anggota)
                                ->groupBy('id_jenis_simpanan')
                                ->get();

            $simpanan->$month->total = Simpanan::select(DB::raw('sum(jumlah) as jumlah, sum(saldo) as saldo'))
                                ->whereMonth('created_at', $dt->format('n'))
                                ->whereYear('created_at', $tahun)
                                ->where('id_koperasi', Session::get('id_koperasi'))
                                ->where('id_anggota', $id_anggota)
                                ->get();
        }

        $totalSimpanan = Simpanan::
        whereYear('created_at', $tahun_sebelumnya)
        ->where('id_koperasi', Session::get('id_koperasi'))
        ->where('id_anggota', $id_anggota)
        ->where('id_jenis_simpanan', 1)
        ->sum('jumlah');

        $totalSimpananPokok = Simpanan::
        whereYear('created_at', $tahun_sebelumnya)
        ->where('id_koperasi', Session::get('id_koperasi'))
        ->where('id_anggota', $id_anggota)
        ->where('id_jenis_simpanan', 2)
        ->sum('jumlah');

        $totalSimpananWajib = Simpanan::
        whereYear('created_at', $tahun_sebelumnya)
        ->where('id_koperasi', Session::get('id_koperasi'))
        ->where('id_anggota', $id_anggota)
        ->where('id_jenis_simpanan', 3)
        ->sum('jumlah');

        $totalAllSimpanan = Simpanan::
        whereYear('created_at', $tahun_sebelumnya)
        ->where('id_koperasi', Session::get('id_koperasi'))
        ->where('id_anggota', $id_anggota)
        ->sum('jumlah');

        return view('simpanan.detail', compact('simpanan', 'totalSimpanan', 'totalSimpananPokok', 'totalSimpananWajib', 'totalAllSimpanan', 'anggota', 'tahun_sebelumnya'));
    }

    public function transaksi()
    {
        $simpanan = Simpanan::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->orderBy('id', 'DESC')->paginate(10);

        return view('simpanan.transaksi', compact('simpanan'));
    }

    public function formTambah()
    {
        $jenis = JenisSimpanan::all();
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();

        return view('simpanan.tambah', compact('jenis', 'anggota'));
    }

    public function formEdit($id)
    {
        $jenis = JenisSimpanan::all();
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();
        $simpanan = Simpanan::find($id);

        return view('simpanan.edit', compact('simpanan', 'jenis', 'anggota'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi dengan number !'
        ];

        $this->validate($request, [
            'jumlah' => 'required|numeric'
        ], $message);

        $simpanan = Simpanan::create([
            'id_koperasi' => Session::get('id_koperasi'),
            'id_anggota' => $request->id_anggota,
            'id_jenis_simpanan' => $request->jenis,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'saldo' => 0,
        ]);

        $anggota = Anggota::find($request->id_anggota);

        if ($request->status == 1) {
            if ($request->jenis == 1) {
                $anggota->simpanan += $request->jumlah;

                $anggota->save();

                $simpanan->saldo = $anggota->simpanan;

                $simpanan->save();
            } 
            elseif ($request->jenis == 2) {
                $anggota->simpanan_pokok += $request->jumlah;

                $anggota->save();

                $simpanan->saldo = $anggota->simpanan_pokok;

                $simpanan->save();
            }
            else {
                $anggota->simpanan_wajib += $request->jumlah; 

                $anggota->save();

                $simpanan->saldo = $anggota->simpanan_wajib;

                $simpanan->save();
            }
        }
        else {
            if ($request->jenis == 1 && $anggota->simpanan >= $request->jumlah) {
                $anggota->simpanan -= $request->jumlah;

                $anggota->save();

                $simpanan->saldo = $anggota->simpanan;

                $simpanan->save();
            } 
            elseif ($request->jenis == 2 && $anggota->simpanan_pokok >= $request->jumlah) {
                $anggota->simpanan_pokok -= $request->jumlah;
                
                $anggota->save();

                $simpanan->saldo = $anggota->simpanan_pokok;

                $simpanan->save();
            }
            elseif ($request->jenis == 3 && $anggota->simpanan_wajib >= $request->jumlah) {
                $anggota->simpanan_wajib -= $request->jumlah; 

                $anggota->save();

                $simpanan->saldo = $anggota->simpanan_wajib;

                $simpanan->save();
            }
            else {
                return redirect('/simpanan/tambah')->with('alert-danger', 'jumlah penarikan simpanan melebihi simpanan yang ada ! ');
            }
        }

        return redirect('/simpanan')->with('alert-success', 'berhasil tambah data');
    }

    public function penarikanSimpanan()
    {
        $simpanan = PenarikanSimpanan::where('id_koperasi', Session::get('id_koperasi'))->orderBy('id', 'DESC')->get();

        return view('simpanan.penarikan', compact('simpanan'));
    }

    public function formPenarikanSimpanan($id)
    {
        $simpanan = PenarikanSimpanan::find($id);

        return view('simpanan.detail_penarikan', compact('simpanan'));
    }

    public function verifikasiPenarikanSimpanan(Request $request, $id)
    {
        $simpanan = PenarikanSimpanan::find($id);

        $anggota = Anggota::find($simpanan->id_anggota);

        $simpanan->status = $request->verifikasi;

        $simpanan->save();

        if ($request->verifikasi == 2) {
            $anggota->simpanan -= $simpanan->jumlah;

            $anggota->save();
        }

        return redirect('/simpanan/penarikan')->with('alert-success', 'berhasil verifikasi data !');
    }

    public function uploadBuktiPengiriman($id, Request $request)
    {
        $this->validate($request, [
            'upload_foto' => 'required'
        ], [
            'required' => 'form :attribute tidak boleh kosong!'
        ]);

        $simpanan = PenarikanSimpanan::find($id);

        $simpanan->status = 3;

        //upload image
        $foto = $request->upload_foto;
        $urlFoto = $foto != null ?
            $this->storeImages($foto, 'penarikan_simpanan') : null;

        $simpanan->foto = $urlFoto;

        $simpanan->save();

        return redirect('/simpanan/penarikan')->with('alert-success', 'berhasil upload bukti pengiriman!');
    }
}
