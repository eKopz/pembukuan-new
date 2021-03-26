<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class KategoriToko extends Model
{
    protected $table = "kategori_toko";
    
    protected $fillable  = ['kategori'];

    public function toko()
    {
        return $this->hasMany('App\model\Toko');
    }
}
