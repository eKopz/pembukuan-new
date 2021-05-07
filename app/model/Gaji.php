<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';

    protected $fillable = ['id_karyawan_koperasi', 'makan', 'transport', 'insentif', 'rapel', 'jamsostek', 'status'];

    public function karyawan_koperasi()
    {
        return $this->belongsTo('App\model\KaryawanKoperasi', 'id_karyawan_koperasi');
    }

    public function gaji_bulanan()
    {
        return $this->hasMany('App\model\GajiBulanan');
    }
}
