<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = ['no_anggota', 'id_koperasi', 'id_pengguna', 'simpanan', 'simpanan_wajib', 'simpanan_pokok', 'pinjaman', 'status', 'id_karyawan', 'keterangan', 'nama'];

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koperasi', 'id_koperasi');
    }

    public function pengguna()
    {
        return $this->BelongsTo('App\model\Pengguna', 'id_pengguna');
    }

    public function karyawan()
    {
        return $this->belongsTo('App\model\Karyawan', 'id_karyawan');
    }

    public function pengurus()
    {
        return $this->hasMany('App\model\Pengurus');
    }

    public function simpanan()
    {
        return $this->hasMany('App\model\Simpanan');
    }

    public function penarikan_simpanan()
    {
        return $this->hasMany('App\model\PenarikanSimpanan');
    }

    public function pinjaman()
    {
        return $this->hasMany('App\model\Pinjaman');
    }

    public function karyawan_koperasi()
    {
        return $this->hasMany('App\model\KaryawanKoperasi');
    }
}
