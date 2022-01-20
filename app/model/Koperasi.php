<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Koperasi extends Model
{
    protected $table = "koperasi";

    protected $fillable = ['nama', 'jenis_koperasi', 'badanHukum', 'thnBerdiri', 'alamat', 'deskripsi', 'jam_buka', 'jam_tutup', 'foto', 'id_users', 'banner', 'syarat', 'syarat_pinjaman', 'warna'];

    public function toko()
    {
        return $this->hasMany('App\model\Toko');
    }

    public function anggota()
    {
        return $this->hasMany('App\model\Anggota');
    }

    public function simpanan()
    {
        return $this->hasMany('App\model\Simpanan');
    }

    public function pinjaman()
    {
        return $this->hasMany('App\model\Pinjaman');
    }

    public function kas()
    {
        return $this->hasMany('App\model\Kas');
    }

    public function user()
    {
        return $this->belongsTo('App\Users', 'id_users');
    }
}
