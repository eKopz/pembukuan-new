<?php

namespace App\Imports;

use App\model\Anggota;
use App\model\Pinjaman;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $anggota = Anggota::create([
                'id_koperasi' => Session::get('id_koperasi'),
                'id_pengguna' => null,
                'simpanan' => $row['simpanan_manasuka'], 
                'simpanan_wajib' => $row['simpanan_wajib'],
                'simpanan_pokok' => $row['simpanan_pokok'], 
                'pinjaman' => $row['sisa_pinjaman'],
                'status' => 4, 
                'id_karyawan' => null,
                'no_anggota' => $row['no_anggota'],
                'nama' => $row['nama'],
                'keterangan' => null,
            ]);

            Pinjaman::create([  
                'id_koperasi' => Session::get('id_koperasi'),
                'id_anggota' => $anggota->id,
                'keterangan' => null,
                'status' => 2,
                'jumlah_pinjaman' => $row['sisa_pinjaman'],
                'jumlah_cicilan' => $row['sisa_cicilan'],
                'angsuran' => 0
            ]);
        }
    }
}
