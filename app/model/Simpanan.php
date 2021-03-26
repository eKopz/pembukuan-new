<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = "simpanan";

    protected $fillable = ['id_anggota', 'id_koperasi', 'id_jenis_simpanan', 'jumlah', 'status', 'saldo'];

    public function anggota()
    {
        return $this->belongsTo('App\model\Anggota', 'id_anggota');
    }

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koerpasi', 'id_koperasi');
    }

    public function jenis_simpanan()
    {
        return $this->belongsTo('App\model\JenisSimpanan', 'id_jenis_simpanan');
    }
}
