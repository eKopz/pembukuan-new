<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class JenisSimpanan extends Model
{
    protected $table = 'jenis_simpanan';

    protected $fillable = ['jenis'];

    public function simpanan()
    {
        return $this->hasMany('App\model\Simpanan');
    }
}
