@extends('adminlte::page')
@section('title_postfix', ' | Create Dear Service')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dearservice.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\Dear Service\dear_service.png" />
    @if (Auth::user()->can('dearservice.tracker'))
        <div class="float-right">
            <a href="/dearservice/tracker" class="btn btn-info" type="button" title="return">
                <i class="fas fa-undo"></i>
            </a>
        </div>
    @endif
    <h1 class="title_h1">Dear Service Tracker Create</h1>
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
                            {!! Form::open(['route' => 'tracker.store', 'method' => 'POST']) !!}
                            <div class="card col-md-12" id="options">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            {!! Form::label('custumer_name', 'Custumer Name') !!}<span class="span_label">*</span>
                                            {!! Form::text('custumer_name', null, ['class' => 'form-control', 'maxlength' => 60, 'required']) !!}
                                            @include('errors.errors', ['field' => 'custumer_name'])
                                        </div>
                                        <div class="form-group col-sm-6">
                                            {!! Form::label('phone_number', 'Phone Number') !!}<span class="span_label">*</span>
                                            {!! Form::tel('phone_number', null, ['class' => 'form-control', 'maxlength' => 11, 'required']) !!}
                                            @include('errors.errors', ['field' => 'phone_number'])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            {{ Form::label('disposition', 'Disposition') }} <span
                                                class="span_label">*</span>
                                            {{ Form::select('disposition', $disposition, null, ['placeholder' => 'Select Disposition', 'class' => 'custom-select  ' . ($errors->has('disposition') ? 'is-invalid' : ''), 'required']) }}
                                            @include('errors.errors', ['field' => 'disposition'])
                                        </div>
                                        <div class="form-group col-sm-6">
                                            {{ Form::label('call_attempts', 'Call Attempts') }} <span
                                                class="span_label">*</span>
                                            {{ Form::select('call_attempts', $call, null, ['placeholder' => 'Select Call Attepts', 'class' => 'custom-select  ' . ($errors->has('call_attempts') ? 'is-invalid' : ''), 'required']) }}
                                            @include('errors.errors', ['field' => 'call_attempts'])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <textarea class="form-control" placeholder="Coments" id="comments" name="comments" cols="30" rows="3"
                                                maxlength="150" minlength="10" required></textarea>
                                            <span class="badge bg-primary float-right" id="characterCount">0/150</span>
                                            @include('errors.errors', ['field' => 'comments'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary', 'id' => 'boton']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $('textarea').keyup(function() {
            $('#characterCount').text($(this).val().length + "/150")
        })
    </script>
@endpush
