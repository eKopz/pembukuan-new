<?php

namespace App\model;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = "pengguna";

    protected $fillable = ['no_hp', 'jenis_kelamin', 'foto', 'foto_ktp', 'nik', 'ttl', 'id_users'];

    protected $hidden = ['nik'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }

    public function anggota()
    {
        return $this->hasMany('App\model\Anggota');
    }
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
