<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = "karyawan";

    protected $fillable = ['karyawan'];

    public function anggota()
    {
        return $this->hasMany('App\model\Anggota');
    }
}
