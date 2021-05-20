<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';

    protected $fillable = ['id_karyawan_koperasi', 'makan', 'transport', 'insentif', 'rapel', 'jamsostek', 'status', 'id_koperasi', 'potongan_simpanan', 'potongan_simpanan_pokok', 'potongan_simpanan_wajib', 'potongan_pinjaman', 'mangkir', 'total_gaji', 'metode', 'bukti', 'keterangan'];

    public function karyawan_koperasi()
    {
        return $this->belongsTo('App\model\KaryawanKoperasi', 'id_karyawan_koperasi');
    }
}
