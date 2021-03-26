<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "barang";

    protected $fillable = ['nama', 'harga', 'foto1', 'foto2', 'foto3', 'foto4', 'rating', 'stok', 'deskripsi', 'id_toko', 'id_kategori_barang', 'poin'];

    public function kategori_produk()
    {
        return $this->belongsTo('App\model\KategoriBarang', 'id_kategori_barang');
    }
}
