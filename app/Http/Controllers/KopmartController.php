<?php

namespace App\Http\Controllers;

use App\model\KategoriBarang;
use App\model\KategoriToko;
use App\model\Produk;
use App\model\Toko;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class KopmartController extends Controller
{
    public function index()
    {
        $toko = Toko::where('id_koperasi', Session::get('id_koperasi'))->get();

        $jumlah_toko = $toko->count();

        return view('kopmart.index', compact('toko', 'jumlah_toko'));
    }

    // public function detail($id_produk)
    // {
    //     $produk = Produk::find($id_produk);
    // }

    public function formTambah()
    {
        $kategori_toko = KategoriToko::all();

        return view('kopmart.tambah', compact('kategori_toko'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !',
            'numeric' => ':attribute hanya boleh diisi oleh type number !',
            'email' => ':attribute hanya boleh diisi oleh format email', 
            'min:8' => 'jumlah :attribute minimal 8 karakter !',
            'unique:users' => 'email sudah dipakai !',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required', 
            'no_hp' => 'required|numeric',
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:8',
        ], $message);

        $user = User::create([
            'name' => $request->nama, 
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 2,
            'token' => null,
        ]);

        Toko::create([
            'nama' => $request->nama, 
            'alamat' => $request->alamat,
            'rating' => 0,
            'deskripsi' => '-',
            'status' => 1,
            'no_hp' => $request->no_hp,
            'id_users' => $user->id,
            'id_koperasi' => Session::get('id_koperasi'),
            'id_kategori_toko' => $request->id_kategori_toko,
        ]);

        return redirect('/kopmart')->with('alert-success', 'berhasil tambah data !');
    }

    public function produk($id_toko)
    {
        $produk = Produk::where('id_toko', $id_toko)->orderBy('id', 'DESC')->get();

        return view('kopmart.produk', compact('produk'));
    }

    public function kategori($id_toko)
    {   
        $category = Produk::distinct()->where('id_toko', $id_toko)->get(['id_kategori_barang']);

        $products = [];
        
        foreach ($category as $value) {
            $product = Produk::join('kategori_barang', 'barang.id_kategori_barang', '=', 'kategori_barang.id')
                        ->select('kategori_barang.kategori as kategori', DB::raw("count(barang.id) as jumlah"))
                        ->where('barang.id_kategori_barang', $value->id_kategori_barang)
                        ->where('barang.id_toko', $id_toko)
                        ->groupBy('kategori_barang.id')
                        ->get();

            array_push($products, $product);
        }

        return view('kopmart.kategori', compact('products'));
    }

    public function penjualan($id_toko)
    {

        $toko = Toko::find($id_toko);

        $penghasilan = DB::table('penghasilan')->where('id_toko', $id_toko)->sum('jumlah');

        $penjualan = DB::table('pesanan')
                ->select(DB::raw('sum(total_harga+biaya_ongkir) as jumlah'))
                ->where('id_toko', $id_toko)
                ->where('status', 5)
                ->first();

        $order = DB::table('pesanan')
                ->select(DB::raw('count(id) as jumlah'))
                ->where('id_toko', $id_toko)
                ->where('status', '>', 2)
                ->first();

        $pelanggan = DB::table('pesanan')
                ->select(DB::raw('count(id_users) as jumlah'))
                ->where('id_toko', $id_toko)
                ->where('status', '>', 2)
                ->first();

        $pesanan = DB::table('pesanan_barang')
                ->join('pesanan', 'pesanan_barang.id_pesanan', '=', 'pesanan.id')
                ->join('users', 'pesanan.id_users', '=', 'users.id')
                ->join('barang', 'pesanan_barang.id_barang', '=', 'barang.id')
                ->select('users.name as nama_penerima', 'pesanan.created_at as tgl_order', 'pesanan_barang.jumlah', DB::raw('sum(barang.harga + pesanan.biaya_ongkir) as total'), 'pesanan.status as status')
                ->where('pesanan.id_toko', $id_toko)
                ->orderBy('tgl_order', 'DESC')
                ->groupBy('pesanan_barang.id')
                ->get();

        return view('kopmart.penjualan', compact('penghasilan', 'penjualan', 'order', 'pelanggan', 'pesanan', 'toko'));
    }
}
