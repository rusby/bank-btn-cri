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

class CollectionFileExport implements FromView, WithColumnWidths, WithColumnFormatting, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $id;

    public function __construct($id){
        $this->_data = CollectionFile::with(['unitKerja.kantorWilayah', 'userCreated'])->whereId($id)->first();
    }

    public function columnFormats(): array
    {
    	return [
            // 'C' => '0',
            // 'J' => '0'
    	];
    }

    public function registerEvents(): array
    {
    	return [
    		AfterSheet::class    => function(AfterSheet $event) {

    			$event->sheet->getDelegate()->getStyle('A1:O1')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$event->sheet->getDelegate()->getStyle('A4')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$event->sheet->getDelegate()->getStyle('A37')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$event->sheet->getDelegate()->getStyle('A49')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$event->sheet->getDelegate()->getStyle('A76')
    			->getFill()
    			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    			->getStartColor()
    			->setARGB('f06e5d');

    			$arrBorderColor = ['borders' => [
    				'allBorders' => [
    					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    				],
    			]];
    			$event->sheet->getDelegate()->getStyle('A1:O2')->applyFromArray($arrBorderColor);
    			$event->sheet->getDelegate()->getStyle('A5:B35')->applyFromArray($arrBorderColor);
                if ($this->_data->dataDiri->pasangan()->exists()) {
                    $event->sheet->getDelegate()->getStyle('D5:E8')->applyFromArray($arrBorderColor);   
                }    			
    			$event->sheet->getDelegate()->getStyle('A38:B47')->applyFromArray($arrBorderColor);
    			$event->sheet->getDelegate()->getStyle('A50:B74')->applyFromArray($arrBorderColor);
    			$event->sheet->getDelegate()->getStyle('A77:B91')->applyFromArray($arrBorderColor);
    		},
    	];
    }

    public function columnWidths(): array
    {
    	return [
    		'A' => 30,
    		'B' => 50,
    		'C' => 20,
    		'D' => 40,
    		'E' => 30,
            'F' => 40,
    		'G' => 50,
    		'H' => 40,
    		'I' => 30,
            'J' => 30,
            'K' => 30,
            'L' => 40,
            'M' => 40,
            'N' => 40,
            'O' => 40,
    	];
    }

    public function view(): View
    {
    	return view('exports.collections', [
    		'collection' => $this->_data
    	]);
    }
}
