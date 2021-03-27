<?php

namespace App\Imports;

use App\model\Anggota;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;

class AnggotaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggota([
            'id_koperasi' => Session::get('id_koperasi'),
            'id_pengguna' => null,
            'simpanan' => 0, 
            'simpanan_wajib' => 0,
            'simpanan_pokok' => 0, 
            'pinjaman' => 0,
            'status' => 4, 
            'id_karyawan' => null,
            'no_anggota' => $row[1],
            'nama' => $row[2],
            'keterangan' => null,
        ]);
    }
}
