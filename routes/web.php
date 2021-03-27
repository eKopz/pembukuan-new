<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index')->middleware('rolekoperasi'); 

//authentikasi
Route::get('/login', 'AuthController@formLogin');
Route::post('/login/proses', 'AuthController@login');
Route::get('/register', 'AuthController@formRegister');
Route::post('/register/proses', 'AuthController@register');
Route::post('/logout', 'AuthController@logout')->name('logout');


//anggota
Route::group(['prefix' => 'anggota', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'AnggotaController@index');
    Route::get('/detail/{id}', 'AnggotaController@detail');
    Route::get('/tambah', 'AnggotaController@formTambah');
    Route::get('/edit/{id}', 'AnggotaController@formEdit');
    Route::post('/add', 'AnggotaController@add');
    Route::post('/add/import', 'AnggotaController@importData');
    Route::post('/update/{id}', 'AnggotaController@update');
    Route::get('/nonaktif/{id}', 'AnggotaController@nonaktif');
    Route::get('/verifikasi/{id}', 'AnggotaController@formVerifikasi');
    Route::post('/verifikasi/{id}', 'AnggotaController@verifikasi');
});

//karyawan
Route::group(['prefix' => 'karyawan', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'KaryawanController@index');
    Route::get('/tambah', 'KaryawanController@formTambah');
    Route::get('/edit/{id}', 'KaryawanController@formEdit');
    Route::post('/add', 'KaryawanController@add');
    Route::post('/update/{id}', 'KaryawanController@update');
    Route::get('/delete/{id}', 'KaryawanController@delete');
    Route::post('/add/import', 'KaryawanController@importData');
});

//pengurus
Route::group(['prefix' => 'pengurus', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'PengurusController@index');
    Route::get('/detail/{id}', 'PengurusController@detail');
    Route::get('/tambah', 'PengurusController@formTambah');
    Route::get('/edit/{id}', 'PengurusController@formEdit');
    Route::post('/add', 'PengurusController@add');
    Route::post('/update/{id}', 'PengurusController@update');
    Route::get('/delete/{id}', 'PengurusController@delete');
});

//simpanan
Route::group(['prefix' => 'simpanan', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'SimpananController@rekap');
    Route::get('/transaksi', 'SimpananController@transaksi');
    Route::get('/detail/{id}', 'SimpananController@detail');
    Route::get('/tambah', 'SimpananController@formTambah');
    Route::get('/edit/{id}', 'SimpananController@formEdit');
    Route::post('/add', 'SimpananController@add');
    Route::post('/update/{id}', 'SimpananController@update');
    Route::get('/delete/{id}', 'SimpananController@delete');
});

//pinjaman
Route::group(['prefix' => 'pinjaman', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'PinjamanController@rekap');
    Route::get('/transaksi', 'PinjamanController@transaksi');
    Route::get('/detail/{id}', 'PinjamanController@detail');
    Route::get('/pengajuan', 'PinjamanController@pengajuan');
    Route::get('/pengajuan/detail/{id}', 'PinjamanController@detailPengajuan');
    Route::get('/tambah', 'PinjamanController@formTambah');
    Route::get('/angsuran/tambah', 'PinjamanController@formAngsuranTambah');
    Route::get('/edit/{id}', 'PinjamanController@formEdit');
    Route::post('/pengajuan/hitung', 'PinjamanController@hitungPengajuan');
    Route::post('/add', 'PinjamanController@addPinjaman');
    Route::post('/angsuran/add', 'PinjamanController@addAngsuran');
    Route::post('/update/{id}', 'PinjamanController@update');
    Route::get('/delete/{id}', 'PinjamanController@delete');
    Route::get('/verifikasi/{id}', 'PinjamanController@formVerifikasiPinjaman');
    Route::post('/verifikasi/add/{id}', 'PinjamanController@addVerifikasiPinjaman');
});

//kas
Route::group(['prefix' => 'kas', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'KasController@index');
    Route::get('/masuk', 'KasController@kasMasuk');
    Route::get('/keluar', 'KasController@kasKeluar');
    Route::get('/tambah', 'KasController@formTambah');
    Route::get('/edit/{id}', 'KasController@formEdit');
    Route::get('/delete/{id}', 'KasController@delete');
    Route::post('/add', 'KasController@add');
    Route::post('/update/{id}', 'KasController@update');
});

//profile
Route::group(['prefix' => 'profile', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'ProfileController@index');
    Route::post('/upload', 'ProfileController@uploadFoto');
    Route::post('/update', 'ProfileController@update');
});

//kopmart
Route::group(['prefix' => 'kopmart', 'middleware' => 'rolekoperasi'], function()
{
    Route::get('/', 'KopmartController@index');
    Route::get('/detail/{id}', 'KopmartController@detail');
    Route::get('/tambah', 'KopmartController@formTambah');
    Route::post('/add', 'KopmartController@add');
    Route::get('/produk/{id}', 'KopmartController@produk');
    Route::get('/kategori/{id}', 'KopmartController@kategori');
    Route::get('/penjualan/{id}', 'KopmartController@penjualan');
});
