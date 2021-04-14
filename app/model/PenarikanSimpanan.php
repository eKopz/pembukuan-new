<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PenarikanSimpanan extends Model
{
    protected $table = "penarikan_simpanan";

    protected $fillable = ['id_anggota', 'jumlah', 'status', 'id_koperasi', 'foto'];

    public function anggota()
    {
        return $this->belongsTo('App\model\Anggota', 'id_anggota');
    }
}
