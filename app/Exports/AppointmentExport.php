<?php

namespace App\Exports;

use App\CgmAppointmentList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppointmentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $name_file_upload;

    function __construct($name_file_upload)
    {
        $this->name_file_upload = $name_file_upload;
    }

    public function collection()
    {
        return CgmAppointmentList::select(
            "id","company_name","phone_number_combined","executive_first_name","executive_last_name","executive_title","professional_title","executive_gender","mailing_address","mailing_city","mailing_state","mailing_zip_code","mailing_zip_4","location_address","location_city","location_state","location_zip_code","location_zip_4"
        )
        ->where('name_file_upload',$this->name_file_upload)->get();
    }

    public function headings(): array
    {
        return ['Account identifier','Company Name','Phone Number Combined','Executive First Name','Executive Last Name','Executive Title','Professional Title','Executive Gender','Mailing Address','Mailing City','Mailing State','Mailing Zip Code','Mailing Zip 4','Location Address','Location City','Location State','Location ZIP Code','Location ZIP+4'];
    }
}
