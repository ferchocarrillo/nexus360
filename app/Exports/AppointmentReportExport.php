<?php

namespace App\Exports;

use App\CgmAppointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppointmentReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $dates;

    function __construct($dates)
    {
        $this->dates = $dates;
    }


    public function collection()
    {

        return  CgmAppointment::whereDate('cgm_appointments.created_at','>=',$this->dates[0])
        ->whereDate('cgm_appointments.created_at','<=',$this->dates[1])
        ->leftJoin('users','cgm_appointments.user_id','=','users.id')
        ->select('cgm_appointments.id', 'users.username', 'cgm_appointments.callID', 'cgm_appointments.executive_first_name', 'cgm_appointments.executive_last_name', 'cgm_appointments.executive_title', 'cgm_appointments.company_name', 'cgm_appointments.location_address', 'cgm_appointments.location_city', 'cgm_appointments.location_state', 'cgm_appointments.location_zip_code', 'cgm_appointments.phone_number_combined', 'cgm_appointments.disposition', 'cgm_appointments.speciality_of_the_practice', 'cgm_appointments.solutions_currently_being_used', 'cgm_appointments.current_contract_term', 'cgm_appointments.customer_budget', 'cgm_appointments.percent_of_claims_paid', 'cgm_appointments.current_solution_positives', 'cgm_appointments.current_solution_challenges', 'cgm_appointments.additional_participants', 'cgm_appointments.cgm_solutions_of_interest', 'cgm_appointments.confirmed_email', 'cgm_appointments.appointment_date', 'cgm_appointments.lunch_and_learn', 'cgm_appointments.comments', 'cgm_appointments.created_at', 'cgm_appointments.updated_at')
        ->get();
    }


    

    public function headings(): array
    {
        return ['id', 'username', 'callID', 'executive_first_name', 'executive_last_name', 'executive_title', 'company_name', 'location_address', 'location_city', 'location_state', 'location_zip_code', 'phone_number_combined', 'disposition', 'speciality_of_the_practice', 'solutions_currently_being_used', 'current_contract_term', 'customer_budget', 'percent_of_claims_paid', 'current_solution_positives', 'current_solution_challenges', 'additional_participants', 'cgm_solutions_of_interest', 'confirmed_email', 'appointment_date', 'lunch_and_learn', 'comments', 'created_at', 'updated_at'];
    }
}
