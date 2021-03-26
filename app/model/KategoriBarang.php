<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $table = "kategori_barang";

    protected $fillable = ['kategori'];

    public function produk()
    {
        return $this->hasMany('App\model\Produk');
    }
}
