<?php

use Illuminate\Database\Seeder;
use App\CgmAppointmentDisposition;

class CgmAppointmentDispositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CgmAppointmentDisposition::truncate();

        CgmAppointmentDisposition::firstOrCreate(['name' => "Wrong Number", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Answering Machine", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Answer", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Disconnected Number", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Fax Number", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Do not call", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Influencer Not Available", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Influencer Personlized Callback", 'required_appointment' => 0, 'required_date' => 1]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Gatekeeper Random Callback (any agent + specific time)", 'required_appointment' => 0, 'required_date' => 1]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Can't get passed gatekeeper", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Dropped Call", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Influencer Personalized Callback", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "Dropped Call", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "BANT Appointment Set", 'required_appointment' => 1, 'required_date' => 1]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Appointment Set - No Budget", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Appointment Set - No Authority", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Appointment Set - No Need", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Appointment Set - Not within 2 weeks", 'required_appointment' => 0, 'required_date' => 0]);
        CgmAppointmentDisposition::firstOrCreate(['name' => "No Appointment Set - Not interested", 'required_appointment' => 0, 'required_date' => 0]);
        
        


    }
}
