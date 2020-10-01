<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CgmAppointmentList extends Model
{
    protected $fillable = [
        "id","company_name","phone_number_combined","executive_first_name","executive_last_name","executive_title","professional_title","executive_gender","mailing_address","mailing_city","mailing_state","mailing_zip_code","mailing_zip_4","location_address","location_city","location_state","location_zip_code","location_zip_4","name_file_upload"
    ];
}
