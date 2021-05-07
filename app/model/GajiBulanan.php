<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class GajiBulanan extends Model
{
    protected $table = 'gaji_bulanan';

    protected $fillable = ['id_gaji', 'metode', 'jumlah', 'bukti', 'keterangan', 'status'];

    public function gaji()
    {
        return $this->belongsTo('App\model\Gaji', 'id_gaji');
    }
}
