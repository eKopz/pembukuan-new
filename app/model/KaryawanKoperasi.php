<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class KaryawanKoperasi extends Model
{
    protected $table = 'karyawan_koperasi'; 

    protected $fillable = ['id_anggota', 'loker', 'gaji_pokok', 'bank', 'no_rekening', 'id_pajak', 'potong_gaji', 'status', 'id_koperasi'];

    public function anggota()
    {
        return $this->belongsTo('App\model\Anggota', 'id_anggota');
    }

    public function pajak()
    {
        return $this->belongsTo('App\model\Pajak', 'id_pajak');
    }

    public function gaji()
    {
        return $this->hasMany('App\model\Gaji');
    }

    public function potongGaji()
    {
        return $this->belongsTo('App\model\PotongGaji', 'potong_gaji');
    }
}
