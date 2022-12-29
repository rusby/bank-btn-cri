<?php

namespace App\Exports;

use App\Models\Collection\CollectionFile;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\{
	FromView,
	FromQuery,
	WithHeadings,
	WithColumnWidths,
	WithColumnFormatting,
	WithEvents
};
use Maatwebsite\Excel\Events\AfterSheet;

class CollectionTabulasiExport implements FromView, WithColumnWidths, WithColumnFormatting, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $total, $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function columnFormats(): array
    {
    	return [
            // 'C' => '0',
            // 'J' => '0',
    		'H' => NumberFormat::FORMAT_NUMBER_00
    	];
    }

    public function registerEvents(): array
    {
    	return [
    		AfterSheet::class    => function(AfterSheet $event) {

    			$event->sheet->getDelegate()->getStyle('A1:T1')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$arrBorderColor = ['borders' => [
    				'allBorders' => [
    					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    				],
    			]];
    			$event->sheet->getDelegate()->getStyle("A1:T{$this->total}")->applyFromArray($arrBorderColor);
    		},
    	];
    }

    public function columnWidths(): array
    {
    	return [
    		'A' => 30,
            'B' => 20,
            'C' => 20,
            'D' => 30,
            'E' => 30,
            'F' => 40,
            'G' => 50,
            'H' => 40,
            'I' => 40,
            'J' => 30,
            'K' => 25,
            'L' => 30,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 25,
            'R' => 25,
            'S' => 30,
            'T' => 20,
    	];
    }

    public function view(): View
    {
        $data = $this->data;
        $this->total = count($data) + 1;
    	return view('exports.collections_tabulasi', [
    		'collections' => $data
    	]);
    }
}
