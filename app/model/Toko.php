<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = "toko";

    protected $fillable = ['nama', 'alamat', 'foto', 'rating', 'no_hp', 'deskripsi', 'status', 'id_users', 'id_koperasi', 'id_kategori_toko', 'provinsi' , 'kota', 'kecamatan'];
}
