<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = "kas";

    protected $fillable = ['no_bukti', 'uraian', 'jenis_kas', 'jumlah', 'id_koperasi'];

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koperasi', 'id_koperasi');
    }
}
