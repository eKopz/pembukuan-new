<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = "alamat";

    public function user()
    {
        return $this->belongsTo('App\User', 'id_users');
    }
}
