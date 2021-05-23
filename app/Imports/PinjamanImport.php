<?php

namespace App\Imports;

use App\model\Anggota;
use App\model\AngsuranPinjaman;
use App\model\Pinjaman;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PinjamanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $anggota = Anggota::where('no_anggota', $row['no_anggota'])->first();

            if ($anggota != null && $anggota->pinjaman >= $row['jumlah']) {
                $pinjaman  = Pinjaman::where('id_anggota', $anggota->id)->where('status', 2)->first();

                $jasa = $row['jumlah'] * 1/100;

                $jumlah_angsuran = $row['jumlah'] + $jasa;
                
                $angsuran_pinjaman = AngsuranPinjaman::create([
                    'id_pinjaman' => $pinjaman->id,
                    'jumlah' => $jumlah_angsuran,
                    'saldo' => 0,
                    'angsuran' => 0,
                ]);
                
                $cicilan = 1;

                $anggota->pinjaman -= $row['jumlah']; 

                $anggota->save();

                $pinjaman->angsuran += $cicilan;

                $pinjaman->save();

                $angsuran_pinjaman->saldo = $anggota->pinjaman;

                $angsuran_pinjaman->angsuran += $pinjaman->angsuran;

                $angsuran_pinjaman->save();
            }
        }
    }
}
