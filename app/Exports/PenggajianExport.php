<?php

namespace App\Exports;

use App\model\Gaji;
use App\model\Koperasi;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenggajianExport implements FromView, ShouldAutoSize, WithStyles, WithEvents
{
    private $month;

    private $year;

    public function __construct($month, $year)
    {   
        $this->month = $month;
        $this->year = $year;
    }

    public function styles(Worksheet $sheet)
    {
        $gaji = Gaji::whereMonth('gaji.created_at', $this->month)
                ->whereYear('gaji.created_at', $this->year)
                ->where('gaji.id_koperasi', Session::get('id_koperasi'))
                ->count();
    
        $getCountData = $gaji + 7;

        $range = "A4:AD".$getCountData;

        $styleArray = array(
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
          );
        

        $sheet->getStyle($range)->applyFromArray($styleArray);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A4:AD6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }

    public function view(): View
    {
        $gaji = Gaji::join('karyawan_koperasi', 'gaji.id_karyawan_koperasi', '=', 'karyawan_koperasi.id')
                ->select('gaji.*', 'karyawan_koperasi.loker as loker', 'karyawan_koperasi.gaji_pokok as gaji_pokok')
                ->whereMonth('gaji.created_at', $this->month)
                ->whereYear('gaji.created_at', $this->year)
                ->where('gaji.id_koperasi', Session::get('id_koperasi'))
                ->orderBy('karyawan_koperasi.loker', 'ASC')
                ->get();
        
        $month = $this->month;

        $year = $this->year;
        
        $koperasi = Koperasi::find(Session::get('id_koperasi'));

        return view('penggajian.rincian_gaji_export', compact('gaji', 'koperasi', 'month', 'year'));
    }

}
