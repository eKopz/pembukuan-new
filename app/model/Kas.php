<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Kas extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = "kas";

    protected $fillable = ['no_bukti', 'uraian', 'jenis_kas', 'jumlah', 'id_koperasi'];

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koperasi', 'id_koperasi');
    }
}
