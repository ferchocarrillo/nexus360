@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Tracker Edit')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
    <a href="/moduurn/calltracker" class="btn btn-info float-right" type="button" title="return"><i class="fas fa-undo"></i></a>
    <h1 class="title_h1"> Moduurn Tracker Edit</h1>
@stop
@section('content')
    {!! Form::model($trkEdit, ['route' => ['calltracker.update', $trkEdit->id], 'method' => 'PATCH']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card_first">
                <div class="card-body">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <div class="form-group col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-4">
                                        {!! Form::label('reasonnotschedule', 'Reason Not Schedule') !!}
                                        {{ Form::select('reason_not_schedule', $reason, null, ['class' => 'custom-select ' . ($errors->has('reason_not_schedule') ? 'is-invalid' : ''), 'required']) }}
                                    </div>
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
                                        {!! Form::label('list_id', 'List Id') !!}
                                        {!! Form::text('list_id', null, ['placeholder' => 'list_id', 'class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-3">
                                        {!! Form::label('type', 'Type') !!}
                                        {!! Form::select('type', $type, null, [
                                            'class' => 'custom-select ',
                                            'required',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('not_show', 'Not Show') !!}
                                        <br>
                                        {!! Form::label('not_show', 'Yes') !!}
                                        {!! Form::radio('not_show', 'yes', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                        {!! Form::label('not_show', 'No') !!}
                                        {!! Form::radio('not_show', 'no', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('is_schedule', 'Is Schedule') !!}
                                        <br>
                                        {!! Form::label('is_schedule', 'Yes') !!}
                                        {!! Form::radio('is_schedule', 'yes', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                        {!! Form::label('is_schedule', 'No') !!}
                                        {!! Form::radio('is_schedule', 'no', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('transferCall', 'Transfer Call') !!}
                                        <br>
                                        {!! Form::label('transferCall', 'Yes') !!}
                                        {!! Form::radio('transferCall', 'yes', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                        {!! Form::label('transferCall', 'No') !!}
                                        {!! Form::radio('transferCall', 'no', null, ['class' => 'p-4', 'font-bold' => true]) !!}
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        <div class="form-group">
                                            {{ Form::label('appointment_date', 'Date Schedule') }}
                                            {{ Form::input('datetime-local', 'date_schedule', null, ['class' => 'form-control ' . ($errors->has('appointment_date') ? 'is-invalid' : '')]) }}
                                            @include('errors.errors', ['field' => 'appointment_date'])
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('country', 'Country') !!}
                                        <input type="text" name="country" id="country" class="form-control" value="{{$trkEdit->country}}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('region', 'Region') !!}
                                        <input type="text" name="region" id="region" class="form-control" value="{{$trkEdit->region}}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-2">
                                        {!! Form::label('state', 'State') !!}
                                        <input type="text" name="state" id="state" class="form-control" value="{{$trkEdit->state}}" disabled>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-4">
                                        {!! Form::label('expert', 'Expert') !!}
                                        {!! Form::select('expert', $expert, null, [
                                            'class' => 'custom-select ',
                                            'required', 'disabled'
                                        ]) !!}
                                    </div>
                                    <button id="boton" type="submit" class="btn btn-primary botones"><i
                                            class="fas fa-save"></i>&nbspConfirmation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop
