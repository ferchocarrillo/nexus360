<div class="row">

    {{ Form::hidden('callID',$dataCall->id) }}

    <div class="col-12">
        <div class="form-group row mb-0">
            {{ Form::label('executive_first_name','First Name',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('executive_first_name',$dataCall->executive_first_name, ['class' => 'form-control '.($errors->has('executive_first_name') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'executive_first_name'])
        </div>

        <div class="form-group row mb-0">
            {{ Form::label('executive_last_name','Last Name',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('executive_last_name',$dataCall->executive_last_name, ['class' => 'form-control '.($errors->has('executive_last_name') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'executive_last_name'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('executive_title','Executive Title',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('executive_title',$dataCall->executive_title, ['class' => 'form-control '.($errors->has('executive_title') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'executive_title'])
        </div>
        
        <div class="form-group row mb-0">
            {{ Form::label('company_name','Company Name',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('company_name',$dataCall->company_name, ['class' => 'form-control '.($errors->has('company_name') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'company_name'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('location_address','Address',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('location_address',$dataCall->location_address, ['class' => 'form-control '.($errors->has('location_address') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'location_address'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('location_city','City',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('location_city',$dataCall->location_city, ['class' => 'form-control '.($errors->has('location_city') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'location_city'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('location_state','State',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('location_state',$dataCall->location_state, ['class' => 'form-control '.($errors->has('location_state') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'location_state'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('location_zip_code','ZIP Code',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('location_zip_code',$dataCall->location_zip_code, ['class' => 'form-control '.($errors->has('location_zip_code') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'location_zip_code'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('phone_number_combined','Phone Number',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-10">
                {{ Form::text('phone_number_combined',$dataCall->phone_number_combined, ['class' => 'form-control '.($errors->has('phone_number_combined') ? 'is-invalid' : '')]) }}
            </div>
            @include('errors.errors',['field'=> 'phone_number_combined'])
        </div>
        <div class="form-group row mb-0">
            {{ Form::label('i_am_calling_from','I am calling from',['class'=>'col-sm-2']) }}
            <div class="col-sm-10">
                {{ Form::text(null,($dataCall->location_state == 'NC' || $dataCall->location_state == 'SC' || $dataCall->location_state == 'GA' ? 'Columbia, SC' :($dataCall->location_state == 'NM' || $dataCall->location_state == 'AZ' || $dataCall->location_state == 'CA' ? 'Phoenix, AZ' : ''  ) ),['class'=>'form-control','readonly'=>true]) }}
            </div>
        </div>
        <hr>
    </div>


    <div class="col-12">
        <div class="form-group">
            {{ Form::label('disposition','Disposition') }}
            {{ Form::select('disposition', ['' => 'Select Disposition'] + $dispositions,null, ['class' => 'form-control '. ($errors->has('disposition') ? 'is-invalid' : '')]) }}
            @include('errors.errors',['field'=> 'disposition'])
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('speciality_of_the_practice','Speciality of the practice') }}
            {{ Form::text('speciality_of_the_practice',null, ['class' => 'form-control '.($errors->has('speciality_of_the_practice') ? 'is-invalid' : '')]) }}
            @include('errors.errors',['field'=>'speciality_of_the_practice'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('solutions_currently_being_used', 'Solutions currently being used') }}
            {{ Form::text('solutions_currently_being_used',null, ['class' => 'form-control '.($errors->has('solutions_currently_being_used') ? 'is-invalid' : '')]) }}
            @include('errors.errors',['field'=> 'solutions_currently_being_used'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_contract_term','Current contract term') }}
            {{ Form::text('current_contract_term',null,['class' => 'form-control '.($errors->has('current_contract_term') ? 'is-invalid' : '')]) }}
            @include('errors.errors',['field' => 'current_contract_term'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('customer_budget', 'Customer budget') }}
            {{ Form::text('customer_budget',null,['class'=> 'form-control '.($errors->has('customer_budget') ? 'is-invalid' : '')]) }}
            @include('errors.errors',['field' => 'customer_budget'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('percent_of_claims_paid', 'Percent of claims paid') }}
            {{ Form::number('percent_of_claims_paid',null,['class'=> 'form-control '.($errors->has('percent_of_claims_paid') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'percent_of_claims_paid'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_solution_positives', 'Current solution positives') }}
            {{ Form::text('current_solution_positives',null,['class'=>'form-control '.($errors->has('current_solution_positives') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'current_solution_positives'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_solution_challenges', 'Current solution challenges/wish list') }}
            {{ Form::text('current_solution_challenges',null,['class'=>'form-control '.($errors->has('current_solution_challenges') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'current_solution_challenges'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('additional_participants', 'Additional participants') }}
            {{ Form::text('additional_participants',null,['class'=>'form-control '.($errors->has('additional_participants') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'additional_participants'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('cgm_solutions_of_interest', 'CGM solutions of interest') }}
            {{ Form::text('cgm_solutions_of_interest',null,['class'=>'form-control '.($errors->has('cgm_solutions_of_interest') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'cgm_solutions_of_interest'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('confirmed_email', 'Confirmed email') }}
            {{ Form::email('confirmed_email',null,['class'=>'form-control '.($errors->has('confirmed_email') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'confirmed_email'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('appointment_date', 'Appointment date') }}
            {{ Form::input('datetime-local','appointment_date',null,['class'=>'form-control '.($errors->has('appointment_date') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'appointment_date'])
        </div>
    </div>
    @if($dataCall->location_state == 'AZ' || $dataCall->location_state == 'SC')
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('lunch_and_learn', 'Lunch & Learn') }}
            {{ Form::checkbox('lunch_and_learn',null, null,['class'=>'d-block']) }}
            @include('errors.errors', ['field'=>'lunch_and_learn'])

        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('comments', 'Comments') }}
            {{ Form::textarea('comments',null,['class'=>'form-control '.($errors->has('comments') ? 'is-invalid' : '')]) }}
            @include('errors.errors', ['field'=>'comments'])
        </div>
    </div>

    <div class="col-md-12">
        <div class="from-group">
            <button class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Save
            </button>
        </div>
    </div>


</div>