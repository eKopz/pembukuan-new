<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = "pengguna";

    protected $fillable = ['id_users', 'no_hp', 'jenis_kelamin', 'foto', 'noktp', 'foto_ktp', 'ttl', 'pekerjaan'];

    public function anggota()
    {
        return $this->hasMany('App\model\Anggota');
    }

    public function alamat()
    {
        return $this->hasMany('App\model\Alamat');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }
}
