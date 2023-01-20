@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/enercare.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
    @if (Auth::user()->can('enercare.support'))
        <div class="float-right">
            <a href="/enercare/supportfacilitator" class="btn btn-info" type="button" title="return"><i
                    class="fas fa-undo"></i></a>
        </div>
    @endif
    <h1 class="title_h1">Enercare Tracker Support Facllitator</h1>
@stop
@section('content')
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
                            {!! Form::open(['route' => 'supportfacilitator.store', 'method' => 'POST']) !!}
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-4">
                                    {{ Form::label('agent', 'Agent') }}<span class="span_label">*</span>
                                    {{ Form::select('agent', $agent, null, ['placeholder' => 'Select a Agent', 'class' => 'custom-select ', 'id' => 'agent', 'required']) }}
                                    @include('errors.errors', ['field' => 'agent'])
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-4">
                                    {{ Form::label('process', 'Process') }}<span class="span_label">*</span>
                                    <select name="process" id="process" class="custom-select" required>
                                        <option value selected disabled>Select Process</option>
                                        @foreach ($Process as $process => $specifics)
                                            <option value="{{ $process }}">{{ $process }}</option>
                                        @endforeach
                                    </select>
                                    @include('errors.errors', ['field' => 'process'])
                                </div>
                                <div class="form-group col-md-6 col-lg-4" id="div_specific" name="div_specific"
                                    style="display: none">
                                    {{ Form::label('process_specific', 'Specific Process') }}<span class="span_label">*</span>
                                    <select name="process_specific" id="specifics" class="custom-select" required>
                                        <option value selected disabled>Select Specific Process</option>
                                    </select>
                                    @include('errors.errors', ['field' => 'process_specific'])
                                </div>
                                <div class="form-group  col-md-6 col-lg-4" id="div_additional" name="div_additional"
                                    style="display: none">
                                    {{ Form::label('additional', 'Additional') }}<span class="span_label">*</span>
                                    <select name="additional_details" id="additional_details" class="custom-select">
                                        <option value selected disabled>Select Additional Details</option>
                                    </select>
                                    @include('errors.errors', ['field' => 'additional_details'])
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-lg-3" id="div_behavior">
                                    {{ Form::label('behavior_identified', 'Behavior Identified') }}<span
                                        class="span_label">*</span>
                                    {{ Form::select('behavior_identified', $behavior, null, ['placeholder' => 'Select Behavior Identified', 'class' => 'custom-select  ' . ($errors->has('behavior_identified') ? 'is-invalid' : ''), 'id' => 'behavior_identified']) }}
                                    @include('errors.errors', ['field' => 'behavior_identified'])
                                </div>
                                <div class="form-group col-md-6 col-lg-5" id="div_recomendations">
                                    {{ Form::label('recomendations', 'Recommendations to Supervisor/Team Lead Dropdowns') }}<span
                                        class="span_label">*</span>
                                    {{ Form::select('recomendations', $recomendations, null, ['placeholder' => 'Select recomendations', 'class' => 'custom-select  ' . ($errors->has('recomendations') ? 'is-invalid' : ''), 'id' => 'recomendations']) }}
                                    @include('errors.errors', ['field' => 'recomendations'])
                                </div>
                                <div class="form-group col-md-6 col-lg-2">
                                    {{ Form::label('repeated_interaction', 'Repeated Interaction') }}
                                    <select id="repeated_interaction" name="repeated_interaction" class="custom-select">
                                    <option value="1" selected>Select a option</option>
                                    @foreach ($interaction as $int)
                                        <option value="{{$int }}">{{ $int }}</option>
                                    @endforeach
                                </select>
                                    @include('errors.errors', ['field' => 'repeated_interaction'])
                                </div>
                                <div class="form-group col-md-6 col-lg-5">
                                    <label class="label_text" for="observations">Free Form option as a back up</label>
                                    <textarea class="form-control" placeholder="Observations" id="observations" name="observations" cols="30"
                                        rows="3" maxlength="150" minlength="10" required></textarea>
                                    <span class="badge bg-primary float-right" id="characterCount">0/150</span>
                                @include('errors.errors', ['field' => 'repeated_interaction'])
                                </div>

                                <div class="form-group col-md-6 col-lg-5">
                                    {!! Form::label('supervisor_assistence', 'Supervisor Assistance?') !!}
                                    <input type="checkbox" name="supervisor_assistence" id="supervisor_assistence" value="yes">
                                </div>

                                <input type="hidden" name="conference_in" id="conference_in" value="no" >
                                <input type="hidden" id="excepcion" name="excepcion">
                            </div>
                            {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary' ,'id'=> 'boton']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
@push('js')
    <script>
        'use strict'
        const processes = @json($Process);
        const oldValues = @json(old());
        $('#process').change(function(e) {
            var process = $('#process').val()
            var options = ["<option value selected disabled>Select a Specifics</option>"]
            if (process) {
                var specifics = Object.keys(processes[process]).map(r => {
                    return `<option value="${r}">${r}</option>`
                })
                options = options = options.concat(specifics).join('')
            }
            $('#div_specific').show();
            $('#specifics').html(options).val('');
        })
        $('#specifics').change(function(e) {
            var process = $('#process').val()
            var specific = $('#specifics').val()
            var options = ["<option value selected disabled>Select Additional Detail</option>"]
            if (process && specific) {
                var additional_details = processes[process][specific].map(e => {
                    return `<option value="${e}">${e}</option>`
                })
                options = options.concat(additional_details).join('')
            }
            if ($('#specifics').val() ==
                "Tool Navigation (be specific to DEBE, Clarify, Doculink, NS, SalesForce)") {
                $('#excepcion').val("1");
                $('#div_additional').show();
                $('#additional_details').html(options).val('');
            } else if ($('#specifics').val() == "Charges on Bill") {
                $('#excepcion').val("1");
                $('#div_additional').show();
                $('#additional_details').html(options).val('');
            } else if ($('#specifics').val() == "Unsuitable Appointments") {
                $('#excepcion').val("1");
                $('#div_additional').show();
                $('#additional_details').html(options).val('');
            } else if ($('#specifics').val() == "Moves") {
                $('#excepcion').val("1");
                $('#div_additional').show();
                $('#additional_details').html(options).val('');
            } else {
                $('#div_additional').hide();
                $('#excepcion').val("0");
            }
        });

        $('#repeated_interaction').change(function (){
            var interaction = $('#repeated_interaction').val()

            if( interaction != "3"){
                $('#conference_in').val("no");
            } else {
                $('#conference_in').val("yes");
            }
        });

        var checkbox = document.getElementById('supervisor_assistence');
        checkbox.addEventListener( 'change', function() {
            if(this.checked) {
            $('#behavior_identified').val("");
            $('#div_behavior').hide().removeAttr('required');
            $('#recomendations').val("");
            $('#div_recomendations').hide().removeAttr('required');
            } else {
            $('#div_behavior').show().prop('required',true);
            $('#div_recomendations').show().prop('required',true);
            }
        });
            $('textarea').keyup(function() {
            $('#characterCount').text($(this).val().length + "/150")
        });
    </script>
@endpush
