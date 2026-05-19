<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpWord\SimpleType\Border;

class AnggaranExport implements FromView, ShouldAutoSize, WithStyles
{
    // Definisikan variabel penampung
    protected $rab;
    protected $totalAnggaran;
    protected $id;

    // Tangkap data dari Controller melalui Constructor
    public function __construct($rab, $totalAnggaran, $id)
    {
        $this->rab = $rab;
        $this->totalAnggaran = $totalAnggaran;
        $this->id = $id;
    }

    public function view(): View
    {
        // Kirim variabel langsung, bukan melalui ->data
        return view('exports.template', [
            'rab' => $this->rab,
            'totalAnggaran' => $this->totalAnggaran,
            'id' => $this->id
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Mencari baris terakhir yang ada datanya
        $lastRow = $sheet->getHighestRow();
        $lastCol = $sheet->getHighestColumn();
        $range = 'A1:' . $lastCol . $lastRow;

        return [
            // Memberikan border ke seluruh sel yang terisi
            $range => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::SINGLE,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}