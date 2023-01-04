@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ '\css\moduurn.css' }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
    @if (Auth::user()->can('moduurn.calltracker'))
        <div class="float-right">
            <a href="/moduurn/calltracker" class="btn btn-info" type="button" title="return"><i
                    class="fas fa-undo"></i></a>
        </div>
    @endif
    <h1 class="title_h1">Moduurn Sales Tracker Create</h1>
@stop
@section('content')
    {!! Form::open(['route' => 'calltracker.store', 'method' => 'POST']) !!}
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <div class="col-md-12">
            <div class="card_first">
                <div class="card-body">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <div class="d-inline"><span class="span_label">*</span></div>
                            <div class="d-inline" style="color: black">Required Fields</div>
                            <br>
                            <br>
                            {{--  <h1 class="d-inline"><span class="span_label">*</span>Required Fields</h1>  --}}
                            <div class="form-group col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-4">
                                        {!! Form::label('principal_phone', 'Principal Phone') !!} <span class="span_label">*</span>
                                        {!! Form::tel('phone_number1', null, [
                                            'placeholder' => 'principal_phone',
                                            'class' => 'form-control',
                                            'minlength' => '7',
                                            'maxlength' => '10',
                                            'required',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-4">
                                        {!! Form::label('secundary_phone', 'Secundary Phone') !!}
                                        {!! Form::tel('phone_number2', null, [
                                            'placeholder' => 'secundary_phone',
                                            'class' => 'form-control',
                                            'minlength' => '7',
                                            'maxlength' => '10',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-3">
                                        {!! Form::label('list_id', 'List Id') !!}<span class="span_label">*</span>
                                        {!! Form::text('list_id', null, ['placeholder' => 'list_id', 'class' => 'form-control', 'maxlength' => '20', 'required']) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_not_show">
                                        {!! Form::label('not_show', 'Not Show') !!}<span class="span_label">*</span>
                                        <br>
                                        <input type="radio" name="not_show" id="not_show_yes" onclick="showRadio(id)" value="yes" required = "required"><label>Yes</label>
                                        <input type="radio" name="not_show" id="not_show_no" onclick="showRadio(id)" value="no"><label>No</label><br>


                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_schedule" style="display: none">
                                        {!! Form::label('is_schedule', 'Is Schedule') !!}<span class="span_label">*</span>
                                        <br>
                                        <input type="radio" name="is_schedule" id="is_schedule_yes" onclick="scheduleRadio(id)" value="yes"><label>Yes</label>
                                        <input type="radio" name="is_schedule" id="is_schedule_no" onclick="scheduleRadio(id)" value="no"><label>No</label><br>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_reason" style="display: none">
                                        {!! Form::label('reasonnotschedule', 'Reason Not Schedule') !!}<span class="span_label">*</span>
                                        {!! Form::select('reason_not_schedule', $reason, null, [
                                            'placeholder' => 'Select Reason',
                                            'class' => 'custom-select ',
                                            'id' => 'reason_not_schedule',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_type" style="display: none">
                                        {!! Form::label('type', 'Type') !!}
                                        {!! Form::select('type', $type, null, [
                                            'placeholder' => 'Select Type',
                                            'class' => 'custom-select ',
                                            'id' => 'type',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_transfer_call" style="display: none">
                                        {!! Form::label('transferCall', 'Transfer Call') !!}
                                        <br>
                                        <input type="radio" name="transfer_call" id="transfer_call_yes" ><label>Yes</label>
                                        <input type="radio" name="transfer_call" id="transfer_call_no" ><label>No</label><br>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2" id="div_date_schedule" style="display: none">
                                        <div class="form-group">
                                            {{ Form::label('appointment_date', 'Date Schedule') }}
                                            {{ Form::input('datetime-local', 'date_schedule', null, [
                                                'id' => 'date_schedule','class' => 'form-control ' . ($errors->has('appointment_date') ? 'is-invalid' : ''
                                                )]) }}
                                            @include('errors.errors', ['field' => 'appointment_date'])
                                        </div>
                                    </div>
                                    <div class="form-group  col-md-6 col-lg-2">
                                        {!! Form::label('country', 'Country') !!}<span class="span_label">*</span>
                                        <select name="country" id="country" class="custom-select" required>
                                            <option value selected disabled>Select Country</option>
                                            @foreach ($Countries as $country => $regions)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-6 col-lg-2">
                                        {!! Form::label('regions', 'Regions') !!}<span class="span_label">*</span>
                                        <select name="region" id="regions" class="custom-select" required>
                                            <option value selected disabled>Select Region</option>
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-6 col-lg-2">
                                        {!! Form::label('states', 'States') !!}<span class="span_label">*</span>
                                        <select name="state" id="states" class="custom-select" required>
                                            <option value selected disabled>Select State</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('expert', 'Expert') !!}<span class="span_label">*</span>
                                        {!! Form::select('expert', $expert, null, [
                                            'placeholder' => 'Select expert',
                                            'class' => 'custom-select ',
                                            'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <button id="boton" type="submit"  onclick="validar()"   class="btn btn-primary botones"><i
                                        class="fas fa-save"></i>&nbspSave</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
@push('js')
    <script>
        const countries = @json($Countries);

        $('#country').change(function(e) {
            var country = $('#country').val()
            var options = ["<option value selected disabled>Select Region</option>"]
            if (country) {
                var regions = Object.keys(countries[country]).map(r => {
                    return `<option value="${r}">${r}</option>`
                })
                options = options = options.concat(regions).join('')
            }
            $('#regions').html(options).val('').change();
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


        function showRadio(name) {
            if (name == "not_show_no") {
                document.getElementById("not_show_no").checked = true;
                document.getElementById("not_show_yes").checked = false;
                document.getElementById("is_schedule_no").checked = false;
                document.getElementById("is_schedule_yes").checked = false;
                $("#div_schedule").show();
                $('#reason_not_schedule').val("");
                $('#type').val("");
                document.getElementById("transfer_call_no").checked = false;
                document.getElementById("transfer_call_yes").checked = false;

            } else if (name == "not_show_yes") {
                document.getElementById("not_show_yes").checked = true;
                document.getElementById("not_show_no").checked = false;
                $("#div_schedule").hide();
                $('#reason_not_schedule').val("");
                $('#type').val("");
                document.getElementById("transfer_call_no").checked = false;
                document.getElementById("transfer_call_yes").checked = false;
                $("#date_schedule").val("");
                $("#div_type").hide();
                $("#div_transfer_call").hide();
                $("#div_date_schedule").hide();
            }
        }

        function scheduleRadio(name) {
            if (name == "is_schedule_no") {
                document.getElementById("is_schedule_no").checked = true;
                document.getElementById("is_schedule_yes").checked = false;
                $("#div_reason").show();
                $("#div_type").hide();
                $("#div_transfer_call").hide();
                $("#div_date_schedule").hide();
                $('#reason_not_schedule').val("");
                $('#type').val("");
                document.getElementById("transfer_call_no").checked = false;
                document.getElementById("transfer_call_yes").checked = false;
                $("#date_schedule").val("");


            } else if (name == "is_schedule_yes") {
                document.getElementById("is_schedule_yes").checked = true;
                document.getElementById("is_schedule_no").checked = false;
                $("#div_type").show();

                $("#div_transfer_call").show();
                $("#div_date_schedule").show();
                $("#div_reason").hide();
                $('#reason_not_schedule').val("");
                $('#type').val("");
                document.getElementById("transfer_call_no").checked = false;
                document.getElementById("transfer_call_yes").checked = false;
                $("#date_schedule").val("");

            }
            $('#reason_not_schedule').val("");
        }
        function validar() {
            var elemento = document.getElementById("is_schedule").value
          if (elemento == ""){
            alert("Debes llenar el campo")
            return false
          }else {
            alert("Genial el valor es: "+elemento)
            return false
          }
        }
    </script>
@endpush
