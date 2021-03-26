<?php

namespace App\Http\Controllers;

use App\model\AngsuranPinjaman;
use App\model\Pinjaman;
use App\model\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $pengajuan_pinjaman = Pinjaman::where('status', 1)
                            ->where('id_koperasi', Session::get('id_koperasi'))
                            ->count('id');

        $pinjaman_tersalur = Pinjaman::where('status', 2)
                            ->where('id_koperasi', Session::get('id_koperasi'))
                            ->sum('jumlah_pinjaman');

        $pinjaman_terbayar = AngsuranPinjaman::join('pinjaman', 'angsuran_pinjaman.id_pinjaman', '=', 'pinjaman.id')
                            ->where('pinjaman.id_koperasi', Session::get('id_koeprasi'))
                            ->sum('angsuran_pinjaman.jumlah');

        $total_produk = Produk::join('toko', 'barang.id_toko', 'toko.id')
                        ->where('toko.id_koperasi', Session::get('id_koperasi'))
                        ->count('barang.id');

        $produk_terjual = DB::table('pesanan_barang')
                        ->join('pesanan', 'pesanan_barang.id_pesanan', 'pesanan.id')
                        ->join('toko', 'pesanan.id_toko', 'toko.id')
                        ->where('toko.id_koperasi', Session::get('id_koperasi'))
                        ->count('pesanan_barang.id');

        $total_penjualan = DB::table('pesanan')
                        ->join('toko', 'pesanan.id_toko', 'toko.id')
                        ->where('toko.id_koperasi', Session::get('id_koperasi'))
                        ->sum('pesanan.total_harga');

        return view('dashboard.index', compact('pengajuan_pinjaman', 'pinjaman_tersalur', 'pinjaman_terbayar', 'total_produk', 'produk_terjual', 'total_penjualan'));
    }
}
