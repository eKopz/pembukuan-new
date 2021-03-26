<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = "pengurus";

    protected $fillable = ['id_anggota', 'jabatan', 'status', 'id_koperasi'];

    public function anggota()
    {
        return $this->belongsTo('App\model\Anggota', 'id_anggota');
    }
}
