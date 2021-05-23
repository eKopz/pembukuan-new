<?php

namespace App\Imports;

use App\model\Anggota;
use App\model\Simpanan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SimpananImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $anggota = Anggota::where('no_anggota', $row['no_anggota'])->first();

            if ($anggota != null) {
                $anggota->simpanan += $row['simpanan_manasuka'];
                $anggota->simpanan_wajib += $row['simpanan_wajib'];
                $anggota->simpanan_pokok += $row['simpanan_pokok'];
                $anggota->save();

                if ($row['simpanan_manasuka'] > 0) {
                    Simpanan::create([
                        'id_koperasi' => Session::get('id_koperasi'),
                        'id_anggota' => $anggota->id,
                        'id_jenis_simpanan' => 1,
                        'jumlah' => $row['simpanan_manasuka'],
                        'status' => 1,
                        'saldo' => $anggota->simpanan,
                    ]);               
                }
                if ($row['simpanan_pokok'] > 0) {
                    Simpanan::create([
                        'id_koperasi' => Session::get('id_koperasi'),
                        'id_anggota' => $anggota->id,
                        'id_jenis_simpanan' => 2,
                        'jumlah' => $row['simpanan_pokok'],
                        'status' => 1,
                        'saldo' => $anggota->simpanan_pokok,
                    ]); 
                }
                if ($row['simpanan_wajib'] > 0) {
                    Simpanan::create([
                        'id_koperasi' => Session::get('id_koperasi'),
                        'id_anggota' => $anggota->id,
                        'id_jenis_simpanan' => 3,
                        'jumlah' => $row['simpanan_wajib'],
                        'status' => 1,
                        'saldo' => $anggota->simpanan_wajib,
                    ]); 
                }
            }
        }
    }
}
