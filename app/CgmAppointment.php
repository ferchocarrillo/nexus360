<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CgmAppointment extends Model
{
    protected $fillable = [
        'id', 'user_id', 'callID', 'executive_first_name', 'executive_last_name', 'executive_title', 'company_name', 'location_address', 'location_city', 'location_state', 'location_zip_code', 'phone_number_combined', 'disposition', 'speciality_of_the_practice', 'solutions_currently_being_used', 'current_contract_term', 'customer_budget', 'percent_of_claims_paid', 'current_solution_positives', 'current_solution_challenges', 'additional_participants', 'cgm_solutions_of_interest', 'confirmed_email', 'appointment_date', 'lunch_and_learn', 'comments', 'created_at', 'updated_at'
    ];
}
