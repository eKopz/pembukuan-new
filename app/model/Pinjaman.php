<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = "pinjaman";

    protected $fillable = ['id_koperasi', 'id_anggota', 'slip_gaji', 'ktp', 'surat_pernyataan', 'keterangan', 'jumlah_pinjaman', 'jumlah_cicilan', 'status', 'angsuran'];

    public function anggota()
    {
        return $this->belongsTo('App\model\Anggota', 'id_anggota');
    }

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koerpasi', 'id_koperasi');
    }

    public function angsuran_pinjaman()
    {
        return $this->hasMany('App\model\AngsuranPinjaman');
    }
}
