<?php

namespace App\Exports;

use App\model\Kas;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KasExport implements FromView, ShouldAutoSize
{
    public function __construct($tahun, $mulai, $selesai)
    {
        $this->tahun = $tahun;
        $this->mulai = $mulai;
        $this->selesai = $selesai;
    }
    
    public function view(): View
    {
        $kas = Kas::whereMonth('created_at', '>=', $this->mulai)
        ->whereMonth('created_at', '<=', $this->selesai)
        ->whereYear('created_at', $this->tahun)
        ->where('id_koperasi', Session::get('id_koperasi'))
        ->get();

        return view('kas.excel', compact('kas'));
    }
}
