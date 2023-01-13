@extends('adminlte::page')
@section('title_postfix', ' | Reminders')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
@stop
@section('content_header')
<h1>Send Reminder</h1>
@stop
@section('content')
            <div class="row">
                <div class="col-sm-4">
                    {{ Form::label('filters', 'Filters') }}
                    <select id="filters" name="filters" class="form-control " onChange="selectOption(this)" required>
                        <option value="" selected disabled> Select one option </option>
                        @foreach ($filters as $key => $fil)
                        <option value="{{ $key }}">{{ $fil }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8" id="employess" style="display: none">
                    {{ Form::label('employe', 'Employess') }}
                    <select name="employe[]" id="employe" class="form-control data_option js-example-basic-multiple"
                        multiple="multiple">
                        @foreach ($employess as $employe)
                        <option value="{{ $employe->national_id }}">{{ $employe->national_id }} {{ $employe->full_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8" id="campaigns" style="display: none">
                    {{ Form::label('campaigns', 'Campaigns') }}
                    <select name="campaigns[]" id="campaign" class="form-control data_option js-example-basic-multiple"
                        multiple="multiple">
                        @foreach ($campaigns as $camp)
                        <option value="{{ $camp }}">{{ $camp }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8" id="team_leaders" style="display: none">
                    {{ Form::label('team_leader', 'Team leader') }}
                    <select name="team_leader[]" id="team_leader" class="form-control data_option js-example-basic-multiple"
                        multiple="multiple">
                        @foreach ($team_leaders as $team)
                        <option value="{{ $team }}">{{ $team }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <br>
            <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Suggestion" id="msgReminder" name="msgReminder" rows="8"
                            maxlength="255" minlength="10" required></textarea>
                        <span class="badge bg-primary float-right" id="characterCount">0/255</span>
                    </div>
            </div>
            <div class="row">
                    <div class="col-sm-6" style="margin-left:1.5rem">
                        <input class="form-check-input" type="checkbox" value="1" id="acknowledge">
                        <label class="form-check-label" for="acknowledge">
                            <strong> Select if you require acknowledgment of receipt</strong>
                        </label>
                    </div>
            </div>
            <div id="response" class="form-group"></div>
            <button class="btn btn-primary" id="addREminder"><i class="fas fa-bell"></i> Add Reminder</button>
        @stop
        @push('js')
        <script>
            $.fn.select2.defaults.set("theme", "bootstrap4");
            $.fn.select2.defaults.set("width", "auto");
            function selectOption(sel) {
                divCamp = document.getElementById("campaigns");
                divEmplo = document.getElementById("employess");
                divTeam = document.getElementById("team_leaders");
                if (sel.value == "campaign") {
                    divEmplo.style.display = 'none';
                    divCamp.style.display = 'block';
                    divTeam.style.display = 'none';
                    $('#employe').val('').trigger('change')
                    $('#team_leader').val('').trigger('change')
                }else if (sel.value == "national_id") {
                    divCamp.style.display = 'none';
                    divEmplo.style.display = 'block';
                    divTeam.style.display = 'none';
                    $('#campaign').val('').trigger('change')
                    $('#team_leader').val('').trigger('change')
                }else if (sel.value == "supervisor") {
                    divCamp.style.display = 'none';
                    divEmplo.style.display = 'none';
                    divTeam.style.display = 'block';
                    $('#campaign').val('').trigger('change')
                    $('#employe').val('').trigger('change')
                }else{
                    $('#campaign').val('').trigger('change')
                    $('#employe').val('').trigger('change')
                    $('#team_leader').val('').trigger('change')
                    divCamp.style.display = 'none';
                    divEmplo.style.display = 'none';
                    divTeam.style.display = 'none';
                }
            }
            $(document).ready(() => {
                $('.js-example-basic-multiple').select2({
                    placeholder: "Select one or more options",
                    allowClear: true
                });
                $('textarea').keyup(function() {
                    $('#characterCount').text($(this).val().length + "/255")
                });
                let ifm_reminder = document.querySelector('#ifm_reminder')
                let buttonReminder = document.querySelector("#addREminder")
                let inputReminder = document.querySelector("#msgReminder")
                let employess = $('#employe')
                let team_leader = $("#team_leader")
                let campaigns = $("#campaign")
                let filters = document.querySelector("#filters")
                let acknowledge = document.querySelector("#acknowledge")
                let response = document.querySelector("#response")
                buttonReminder.addEventListener("click", (e) => {
                    if (inputReminder.value == '' || filters.value == ''
                    || (filters.value == 'national_id' && !employess.val().length )
                    || (filters.value == 'supervisor' && !team_leader.val().length )
                    || (filters.value == 'campaign' && !campaigns.val().length )
                    ) {
                        $(response).html(`<div class="alert alert-danger" role="alert">All fields are required</div>`)
                        .find('.alert').delay(3000).slideUp(300);
                        return false;
                    }
                    let filter_data = null
                    switch (filters.value) {
                        case 'campaign':
                            filter_data = campaigns.val();
                            break;
                        case 'national_id':
                            filter_data = employess.val();
                            break;
                        case 'supervisor':
                            filter_data = team_leader.val();
                            break;
                    }
                    $.get('/reminder/create', {
                        filter_data: filter_data,
                        filter: filters.value,
                        acknowledge: acknowledge.checked,
                        reminder: inputReminder.value
                    })
                    .then(users => {
                        let data = {
                            reminder: inputReminder.value,
                            users: users
                        }
                        ifm_reminder.contentWindow.postMessage(JSON.stringify(data), '*')
                        inputReminder.value = "";
                        filter_data = "";
                        acknowledge.checked ="";
                        $("#filters").val("").change();
                        $(response).html(`
                <div class="alert alert-success" role="alert">
                    Reminder Sent Successfully
                </div>
                `).find('.alert')
                                .delay(3000).slideUp(300);
                        })
                })
            })
        </script>
@endpush
