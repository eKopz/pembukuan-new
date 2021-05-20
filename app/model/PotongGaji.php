<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PotongGaji extends Model
{
    protected $table = 'potong_gaji';

    protected $fillable = ['simpanan', 'simpanan_pokok', 'simpanan_wajib', 'pinjaman'];

    public function karyawan_koperasi()
    {
        return $this->hasMany('App\model\KaryawanKoperasi');
    }
}
