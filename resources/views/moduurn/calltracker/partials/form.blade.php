<div class="row">
    <div class="col-md-12">
        <div class="card card_first">
            <div class="card-body">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="span_label">*</span>
                            <span style="color: black">Required Fields</span>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-4">
                                {{ Form::label('principal_phone', 'Principal Phone') }}<span class="span_label">*</span>
                                {{ Form::tel('phone_number1', null, ['placeholder' => 'principal_phone', 'class' => 'form-control ' . ($errors->has('phone_number1') ? 'is-invalid' : ''), 'minlength' => '7', 'maxlength' => '10', 'required']) }}
                                @include('errors.errors', ['field' => 'phone_number1'])
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                {{ Form::label('secundary_phone', 'Secundary Phone') }}
                                {{ Form::tel('phone_number2', null, ['placeholder' => 'secundary_phone', 'class' => 'form-control ' . ($errors->has('phone_number2') ? 'is-invalid' : ''), 'minlength' => '7', 'maxlength' => '10']) }}
                                @include('errors.errors', ['field' => 'phone_number2'])
                            </div>
                            <div class="form-group col-md-6 col-lg-3">
                                {{ Form::label('list_id', 'List Id') }}<span class="span_label">*</span>
                                {{ Form::text('list_id', null, ['placeholder' => 'list_id', 'class' => 'form-control ' . ($errors->has('list_id') ? 'is-invalid' : ''), 'maxlength' => '20', 'required']) }}
                                @include('errors.errors', ['field' => 'list_id'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_not_show">
                                {{ Form::label('not_show', 'Not Show') }}<span class="span_label">*</span>
                                <br>
                                {{ Form::radio('not_show', 'yes', null, ['required']) }}
                                {{ Form::label('', 'Yes') }}
                                {{ Form::radio('not_show', 'no', null, ['required']) }}
                                {{ Form::label('', 'No') }}
                                @include('errors.errors', ['field' => 'not_show'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_schedule" style="display: none">
                                {{ Form::label('is_schedule', 'Is Schedule') }}<span class="span_label">*</span>
                                <br>
                                {{ Form::radio('is_schedule', 'yes', null, ['required', 'disabled']) }}
                                {{ Form::label('', 'Yes') }}
                                {{ Form::radio('is_schedule', 'no', null, ['required', 'disabled']) }}
                                {{ Form::label('', 'No') }}
                                @include('errors.errors', ['field' => 'is_schedule'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_reason" style="display: none">
                                {{ Form::label('reasonnotschedule', 'Reason Not Schedule') }}<span
                                    class="span_label">*</span>
                                {{ Form::select('reason_not_schedule', $reason, null, ['placeholder' => 'Select Reason', 'class' => 'custom-select ', 'id' => 'reason_not_schedule', 'required', 'disabled']) }}
                                @include('errors.errors', ['field' => 'reason_not_schedule'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_type" style="display: none">
                                {{ Form::label('type', 'Type') }} <span class="span_label">*</span>
                                {{ Form::select('type', $type, null, ['placeholder' => 'Select Type', 'class' => 'custom-select  ' . ($errors->has('type') ? 'is-invalid' : ''), 'id' => 'type', 'required', 'disabled']) }}
                                @include('errors.errors', ['field' => 'type'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_transfer_call" style="display: none">
                                {{ Form::label('transferCall', 'Transfer Call') }}<span class="span_label">*</span>
                                <br>
                                {{ Form::radio('transfer_call', 'yes', null, ['required', 'disabled']) }}
                                {{ Form::label('', 'Yes') }}
                                {{ Form::radio('transfer_call', 'no', null, ['required', 'disabled']) }}
                                {{ Form::label('', 'No') }}
                                @include('errors.errors', ['field' => 'transfer_call'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2" id="div_date_schedule" style="display: none">
                                {{ Form::label('date_schedule', 'Date Schedule') }}<span class="span_label">*</span>
                                {{ Form::input('datetime-local', 'date_schedule', null, ['id' => 'date_schedule', 'class' => 'form-control ' . ($errors->has('date_schedule') ? 'is-invalid' : ''), 'required', 'disabled']) }}
                                @include('errors.errors', ['field' => 'date_schedule'])
                            </div>
                            <div class="form-group  col-md-6 col-lg-2">
                                {{ Form::label('country', 'Country') }}<span class="span_label">*</span>
                                <select name="country" id="country" class="custom-select" required>
                                    <option value selected disabled>Select Country</option>
                                    @foreach ($Countries as $country => $regions)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                @include('errors.errors', ['field' => 'country'])
                            </div>
                            <div class="form-group  col-md-6 col-lg-2">
                                {{ Form::label('regions', 'Regions') }}<span class="span_label">*</span>
                                <select name="region" id="regions" class="custom-select" required>
                                    <option value selected disabled>Select Region</option>
                                </select>
                                @include('errors.errors', ['field' => 'region'])
                            </div>
                            <div class="form-group  col-md-6 col-lg-2">
                                {{ Form::label('states', 'States') }}<span class="span_label">*</span>
                                <select name="state" id="states" class="custom-select" required>
                                    <option value selected disabled>Select State</option>
                                </select>
                                @include('errors.errors', ['field' => 'state'])
                            </div>
                            <div class="form-group col-md-6 col-lg-2">
                                {{ Form::label('expert', 'Expert') }}<span class="span_label">*</span>
                                {{ Form::select('expert', $expert, null, ['placeholder' => 'Select expert', 'class' => 'custom-select ', 'required']) }}
                                @include('errors.errors', ['field' => 'expert'])
                            </div>
                        </div>
                        <button id="boton" type="submit" class="btn btn-moduurn">
                            <i class="fas fa-save"></i>&nbspSave
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@push('js')
    <script>
        'use strict'
        const countries = @json($Countries);
        const oldValues = @json(old());

        @if(isset($trkEdit))
            const trackerData = @json($trkEdit);
        @else
            const trackerData = null;
        @endif

        function validateOldValues(old){

            if(!old) return;

            if(old.country){
                $('#country').val(old.country).change()
                
                if(old.region){
                    $('#regions').val(old.region).change()

                    if(old.state){
                        $('#states').val(old.state)
                    }
                }
            }

            if(old.not_show){
                $('input[name="not_show"]').change()
                if(old.is_schedule){
                    $('input[name="is_schedule"][value=' + old.is_schedule + ']').prop('checked', true).change()

                    if(old.reason_not_schedule){
                        $('#reason_not_schedule').val(old.reason_not_schedule)
                    }

                    if(old.type){
                        $('#type').val(old.type)
                    }

                    if(old.date_schedule){
                        $('#date_schedule').val(old.date_schedule)
                    }

                    if(old.transfer_call){
                        $('input[name="transfer_call"][value=' + old.transfer_call + ']').prop('checked', true)
                    }
                }
            }
        }

        $('#country').change(function(e) {
            var country = $('#country').val()
            var options = ["<option value selected disabled>Select Region</option>"]
            if (country) {
                var regions = Object.keys(countries[country]).map(r => {
                    return `<option value="${r}">${r}</option>`
                })
                options = options = options.concat(regions).join('')
            }
            $('#regions').html(options).val('');
            //$('#regions').html(options).val('').change();
        })
        $('#regions').change(function(e) {
            var country = $('#country').val()
            var region = $('#regions').val()
            var options = ["<option value selected disabled>Select State</option>"]
            if (country && region) {
                var states = countries[country][region].map(e => {
                    return `<option value="${e}">${e}</option>`
                })
                options = options.concat(states).join('')
            }
            $('#states').html(options).val('');
        })

        $('input[name="not_show"]').change(function() {
            $('input[name="is_schedule"]').prop("checked", false);
            $('input[name="is_schedule"]').prop("disabled", true);
            $('input[name="is_schedule"]').change()
            if ($(this).is(':checked')) {
                let val = $(this).val();
                if (val == 'yes') {
                    $("#div_schedule").hide();
                } else if (val == 'no') {
                    $("#div_schedule").show();
                    $('input[name="is_schedule"]').prop("disabled", false);
                }
            }
        })

        $('input[name="is_schedule"]').change(function() {
            $("#div_reason").hide();
            $("#div_type").hide();
            $("#div_transfer_call").hide();
            $("#div_date_schedule").hide();

            $('#reason_not_schedule').val("").prop("disabled", true);
            $('#type').val("").prop("disabled", true);
            $('input[name="transfer_call"]').prop("checked", false);
            $('input[name="transfer_call"]').prop("disabled", true);
            $("#date_schedule").val("").prop("disabled", true);

            if ($(this).is(':checked')) {
                let val = $(this).val();
                if (val == 'yes') {
                    $("#div_type").show();
                    $('#type').prop("disabled", false);

                    $("#div_transfer_call").show();
                    $('input[name="transfer_call"]').prop("disabled", false);

                    $("#div_date_schedule").show();
                    $("#date_schedule").prop("disabled", false);
                } else if (val == 'no') {
                    $("#div_reason").show();
                    $('#reason_not_schedule').prop("disabled", false);
                }
            }
        })

        if(Object.keys(oldValues).length == 0){
            validateOldValues(trackerData)
        }else{
            validateOldValues(oldValues)
        }
    </script>
@endpush
