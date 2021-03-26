<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AngsuranPinjaman extends Model
{
    protected $table = 'angsuran_pinjaman';

    protected $fillable = ['id_pinjaman', 'jumlah', 'saldo', 'angsuran'];

    public function pinjaman()
    {
        return $this->belongsTo('App\model\Pinjaman', 'id_pinjaman');
    }
}
