@extends('adminlte::page')
@section('title_postfix', ' | Field Support Resume')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/enercare.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
    <h1 class="title_h1"> Support Facilitator Resume</h1>
    <div class="float-right">
        <a href="/enercare/supportfacilitator" class="btn btn-info" type="button" title="return"><i
                class="fas fa-undo"></i></a>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card_first">
                <div class="card-body">
                    <div class="card mb-0">
                        <div class="card-body">
                            <label for="">Agent</label>
                        <span class="span_item float-right">{{ $facil->agent }}</span><br>
                        <label for="">Process</label>
                        <span class="span_item float-right">{{ $facil->process }}</span><br>
                        <label for="">Process Specific</label>
                        <span class="span_item float-right">{{ $facil->process_specific }}</span><br>
                        <label for="">Additional Details</label>
                        <span class="span_item float-right">{{ $facil->additional_details }}</span><br>
                        <label for="">Behavior Identified</label>
                        <span class="span_item float-right">{{ $facil->behavior_identified }}</span><br>
                        <label for="">Recomendations</label>
                        <span class="span_item float-right">{{ $facil->recomendations }}</span><br>
                        <label for="">Repeated Interaction</label>
                        <span class="span_item float-right">{{ $facil->repeated_interaction }}</span><br>
                        <label for="">Observations</label>
                        <span class="span_item float-right">{{ $facil->observations }}</span><br>
                        <label for="">Conference In</label>
                        <span class="span_item float-right">{{ $facil->conference_in }}</span><br>
                        <label for="">Supervisor Assistence</label>
                        <span class="span_item float-right">{{ $facil->supervisor_assistence }}</span><br>
                        <label for="">Created By</label>
                        <span class="span_item float-right">{{ $facil->creator->name }}</span><br>
                        <label for="">Created</label>
                        <span class="span_item float-right">{{ $facil->created_at }}</span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
