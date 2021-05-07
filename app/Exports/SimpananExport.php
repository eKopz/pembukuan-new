<?php

namespace App\Exports;

use App\model\Anggota;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SimpananExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $simpanan = Anggota::where('id_koperasi', Session::get('id_koperasi'))->get();

        return view('simpanan.excel', compact('simpanan'));
    }
}
