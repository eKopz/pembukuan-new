<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PotongGaji extends Model
{
    protected $table = 'potong_gaji';

    protected $fillable = ['simpanan', 'simpanan_pokok', 'simpanan_wajib', 'pinjaman'];
}
