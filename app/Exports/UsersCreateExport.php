<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersCreateExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    protected $users;

    function __construct($users)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->users);
    }

    public function headings(): array
    {
        return [
            'national_id','name','email','username','password'
        ];
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'font'=>[
                'bold'=>true,
            ]
        ];

        return [
            AfterSheet::class => function(AfterSheet $event) use($styleArray){
                $cellRange = 'A1:E1';
                $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray);
            }
        ];

    }
}
