<?php

namespace App\Http\Controllers;

use App\Exports\PinjamanExport;
use App\Imports\PinjamanImport;
use App\model\Anggota;
use App\model\AngsuranPinjaman;
use App\model\Pengguna;
use App\model\Pinjaman;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PinjamanController extends Controller
{
    public function export(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required',
            'mulai' => 'required',
            'selesai' => 'required'
        ]);

        return Excel::download(new PinjamanExport($request->tahun, $request->mulai, $request->selesai), 'pinjaman.xlsx');
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

        $nama_file = rand()."-pinjaman-".$file->getClientOriginalName();

        $file->move('excel', $nama_file);

        Excel::import(new PinjamanImport, public_path('/excel/'. $nama_file));

        return redirect('/pinjaman')->with('alert-success', 'berhasil tambah data');
    }

    public function rekap()
    {
        $pinjaman = Pinjaman::where('status', 2)->orderBy('id', 'DESC')->get();

        return view('pinjaman.rekap', compact('pinjaman'));
    }

    public function transaksi()
    {
        $angsuran = AngsuranPinjaman::
                    join('pinjaman', 'angsuran_pinjaman.id_pinjaman', '=', 'pinjaman.id')
                    ->select('angsuran_pinjaman.*', 'pinjaman.id_koperasi as id_koperasi')
                    ->where('pinjaman.id_koperasi', Session::get('id_koperasi'))
                    ->where(function($query)
                    {
                        $query->where('pinjaman.status', 2)->orWhere('pinjaman.status', 3);
                    })
                    ->orderBy('angsuran_pinjaman.id', 'DESC')
                    ->paginate(10);

        return view('pinjaman.transaksi', compact('angsuran'));
    }

    public function detail($id_pinjaman)
    {
        $pinjaman = Pinjaman::find($id_pinjaman);

        $anggota = Anggota::find($pinjaman->id_anggota);

        $tahun = Carbon::now()->year;

        $tahun_sebelumnya = $tahun-1;

        $start_month = new \DateTime("$tahun-01-01");
        $end_month = new \DateTime("$tahun-12-01");

        $end_month->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($start_month, $interval, $end_month);
        $months = [];
        $pinjaman = new \stdClass;

        foreach ($period as $dt) {
            setlocale(LC_ALL, 'IND');
            $month = strftime('%B', $dt->format('U'));

            array_push($months, $month);

            $pinjaman->$month = AngsuranPinjaman::select('id_pinjaman', DB::raw('count(jumlah) as jumlah'))
                                ->whereMonth('created_at', $dt->format('n'))
                                ->whereYear('created_at', $tahun)
                                ->where('id_pinjaman', $id_pinjaman)
                                ->groupBy('id_pinjaman')
                                ->get();

            $pinjaman->$month->total = AngsuranPinjaman::select('saldo')
                                ->whereMonth('created_at', $dt->format('n'))
                                ->whereYear('created_at', $tahun)
                                ->where('id_pinjaman', $id_pinjaman)
                                ->latest()
                                ->get();

            
            $pinjaman->$month->angsuran = AngsuranPinjaman::select('angsuran')
                                ->whereMonth('created_at', $dt->format('n'))
                                ->whereYear('created_at', $tahun)
                                ->where('id_pinjaman', $id_pinjaman)
                                ->get();
        }

        $jumlah_pinjaman = Pinjaman::whereYear('created_at', $tahun_sebelumnya)
                            ->where('status', 2)
                            ->where('id', $id_pinjaman)
                            ->sum('jumlah_pinjaman');

        return view('pinjaman.detail', compact('pinjaman', 'anggota', 'tahun_sebelumnya', 'jumlah_pinjaman'));
    }

    public function detailPengajuan($id_pinjaman)
    {
        $pinjaman = Pinjaman::find($id_pinjaman);

        $pinjaman_berjalan = Pinjaman::where('id_anggota', $pinjaman->id_anggota)->where('status', 2)->count();

        return view('pinjaman.detail_pengajuan', compact('pinjaman', 'pinjaman_berjalan'));
    }

    public function formTambah()
    {
        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->get();

        return view('pinjaman.tambah_pengajuan', compact('anggota'));
    }

    public function formAngsuranTambah()
    {
        $pinjaman = Pinjaman::where('status', 2)->orderBy('id', 'DESC')->get();

        return view('pinjaman.angsuran', compact('pinjaman'));
    }

    public function formVerifikasiPinjaman($id_pinjaman)
    {
        $pinjaman = Pinjaman::find($id_pinjaman);

        return view('pinjaman.verifikasi', compact('pinjaman'));
    }

    public function pengajuan()
    {
        $pinjaman = Pinjaman::orderBy('id', 'DESC')->get();

        return view('pinjaman.pengajuan', compact('pinjaman'));
    }

    public function hitungPengajuan(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh type number !'
        ];

        $this->validate($request, [
            'jumlah' => 'required|numeric',
            'cicilan' => 'required|numeric'
        ]);

        $anggota = Anggota::where('id_koperasi', Session::get('id_koperasi'))->where('status', 1)->orderBy('id', 'DESC')->get();

        $id_anggota = $request->id_anggota;

        $jumlah = $request->jumlah;

        $cicilan = $request->cicilan;

        $pembayaran_pokok = $request->jumlah / $request->cicilan;

        $provisi = $request->jumlah * 0.005;

        $jasa = $request->jumlah * $request->cicilan/100 / $request->cicilan;

        return view('pinjaman.tambah_pengajuan2', compact('anggota', 'id_anggota', 'jumlah', 'cicilan', 'pembayaran_pokok', 'provisi', 'jasa'));
    }

    public function addPinjaman(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !', 
            'numeric' => ':attribute hanya boleh diisi oleh angka !', 
            'mimes:pdf,xlsx,csv' => ':attribute hanya boleh diisi oleh file ber-ektensi PDF, XLSX, dan CSV !', 
            'max:2048' => 'file upload tidak boleh melebihi ukuran 2 MB !'
        ];

        $this->validate($request, [
            'jumlah' => 'required|numeric',
            'cicilan' => 'required|numeric',
            'slip_gaji' => 'required|mimes:pdf,xlsx,csv|max:2048',
            'ktp' => 'required|mimes:pdf,xlsx,csv|max:2048',
            'surat_pernyataan' => 'required|mimes:pdf,xlsx,csv|max:2048',
        ]);

        $anggota = Anggota::find($request->id_anggota);

        $pengguna = Pengguna::find($anggota->id_pengguna);
        
        $user = User::find($pengguna->id_users);

        $url = 'https://api.ekopz.id/api/mykoperasi/pinjaman/tambah/'.$user->id.'/'.Session::get('id_koperasi');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$user->token
        ])->attach('slip_gaji', fopen($request->slip_gaji, 'r'))
        ->attach('ktp', fopen($request->ktp, 'r'))
        ->attach('surat_pernyataan', fopen($request->surat_pernyataan, 'r'))
        ->post($url, [
            'jumlah' => $request->jumlah,
            'cicilan' => $request->cicilan,
        ]);

        return redirect('/pinjaman/pengajuan')->with('alert-success', 'pengajuan pinjaman berhasil ditambah!');
    }

    public function addAngsuran(Request $request)
    {
        $cicilan = 1;

        $pinjaman = Pinjaman::find($request->id_pinjaman);

        $angsuran = $pinjaman->jumlah_pinjaman / $pinjaman->jumlah_cicilan;

        $jasa = $angsuran * 1/100;

        $jumlah_angsuran = $angsuran + $jasa;

        $cicilan_now = $pinjaman->jumlah_cicilan + $cicilan;

        // if ($request->jumlah != $jumlah_angsuran) {
        //     return redirect('/pinjaman/angsuran/tambah')->with('alert-danger', 'jumlah tidak sesuai dengan total angsuran. angsuran yang harus dibayar: Rp. '.number_format($jumlah_angsuran,0,',','.'));
        // } 
        // else {
        $anggota = Anggota::find($pinjaman->id_anggota);

        if ($anggota->id_pengguna == null) {
            return redirect('/pinjaman/angsuran/tambah')->with('alert-danger', 'transaksi gagal, anggota harus verifikasi pengguna terlebih dahulu!');
        }
        else{
            $angsuran_pinjaman = AngsuranPinjaman::create([
                'id_pinjaman' => $request->id_pinjaman,
                'jumlah' => $jumlah_angsuran,
                'saldo' => 0,
                'angsuran' => 0,
            ]);

            $anggota->pinjaman -= $angsuran; 

            $anggota->save();

            $pinjaman->angsuran += $cicilan;

            $pinjaman->save();

            $angsuran_pinjaman->saldo = $anggota->pinjaman;

            $angsuran_pinjaman->angsuran += $pinjaman->angsuran;

            $angsuran_pinjaman->save();
            
            if ($pinjaman->jumlah_cicilan == $pinjaman->angsuran) {
                $pinjaman->status = 3;
                
                $pinjaman->save();
            }

            $url = "https://api.ekopz.id/api/notification/pinjaman/angsuran/success/$angsuran_pinjaman->id/".$anggota->pengguna->id_users;

            Http::get($url);

            return redirect('/pinjaman')->with('alert-success', 'angsuran berhasil ditambah');
        }
        // }
    }

    public function addVerifikasiPinjaman(Request $request, $id_pinjaman)
    {
        if ($request->verifikasi == 1) {
            $pinjaman = Pinjaman::find($id_pinjaman);

            $pinjaman->status = 2;

            $anggota = Anggota::find($pinjaman->id_anggota);

            $anggota->pinjaman += $pinjaman->jumlah_pinjaman;

            $pinjaman->keterangan = $request->keterangan;

            $pinjaman->save();

            $anggota->save();

            //push notification pinjaman approve
            $url = "https://api.ekopz.id/api/notification/pinjaman/approve/$pinjaman->id/".$anggota->pengguna->id_users;

            Http::get($url);

            return redirect('/pinjaman/pengajuan')->with('alert-success', 'verifikasi pinjaman berhasil di setujui oleh pengurus !');
        } 
        else {
            $pinjaman = Pinjaman::find($id_pinjaman);

            $pinjaman->status = 4;

            $pinjaman->keterangan = $request->keterangan;

            $pinjaman->save();

            //push notification pinjaman not approved
            $url = "https://api.ekopz.id/api/notification/pinjaman/notapproved/$pinjaman->id/".$pinjaman->anggota->pengguna->id_users;

            Http::get($url);

            return redirect('/pinjaman/pengajuan')->with('alert-success', 'verifikasi pinjaman berhasil di tolak !');
        } 
    }

    public function viewSelectedPinjaman($id_pinjaman)
    {
        $pinjaman = Pinjaman::find($id_pinjaman);

        $angsuran = $pinjaman->jumlah_pinjaman / $pinjaman->jumlah_cicilan;

        $jasa = $angsuran * 1/100;

        $jumlah_angsuran = $angsuran + $jasa;

        $response = "<option value='$jumlah_angsuran'>".$jumlah_angsuran."</option>";

        return response($response);
    }
}
