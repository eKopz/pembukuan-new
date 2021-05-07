<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    protected $table = "pajak";

    protected $fillable = ['kode', 'total_gaji'];

    public function karyawan_koperasi()
    {
        return $this->hasMany('App\model\KaryawanKoperasi');
    }
}
