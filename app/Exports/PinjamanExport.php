<?php

namespace App\Exports;

use App\model\Pinjaman;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PinjamanExport implements FromView, ShouldAutoSize
{
    public function __construct($tahun, $mulai, $selesai)
    {
        $this->tahun = $tahun;
        $this->mulai = $mulai;
        $this->selesai = $selesai;
    }

    public function view(): View
    {
        $pinjaman = Pinjaman::whereMonth('created_at', '>=', $this->mulai)
                    ->whereMonth('created_at', '<=', $this->selesai)
                    ->whereYear('created_at', $this->tahun)
                    ->where('id_koperasi', Session::get('id_koperasi'))
                    ->where('status', 2)
                    ->get();

        return view('pinjaman.excel', compact('pinjaman'));
    }
}
