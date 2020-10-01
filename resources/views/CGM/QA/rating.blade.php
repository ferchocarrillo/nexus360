@extends('adminlte::page')

@section('title_postfix', ' | QA List')

@section('content_header')
<h1>QA Rating - <b>{{$appointment->id}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">

                <form class="form" action="{{ route('cgm.qa.ratingStore') }}" method="POST">
                    @csrf
                    <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="details_confirmed_via_call"
                            name="details_confirmed_via_call">
                        <label class="custom-control-label" for="details_confirmed_via_call">Details Confirmed Via
                            Call</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="voice_recording_sent"
                            name="voice_recording_sent">
                        <label class="custom-control-label" for="voice_recording_sent">Voice Recording Sent</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="accepted_calendar_invite"
                            name="accepted_calendar_invite">
                        <label class="custom-control-label" for="accepted_calendar_invite">Accepted Calendar
                            Invite</label>
                    </div>
                    <button class="btn btn-block btn-primary mt-3" type="submit">Confirm Rating</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src={{"/cgm/reports/pdfView/". $appointment->id}}
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>



@stop