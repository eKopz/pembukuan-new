<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Kopmart extends Model
{
    protected $table = "toko";
    protected $fillable = ['nama', 'alamat', 'rating', 'no_hp', 'deskripsi', 'status', 'id_users', 'id_koperasi','id_kategori_toko'];

    public function koperasi()
    {
        return $this->belongsTo('App\model\Koperasi', 'id_koperasi');
    }

    public function kategori_toko()
    {
        return $this->belongsTo('App\model\KategoriToko', 'id_kategori_toko');
    }
}
