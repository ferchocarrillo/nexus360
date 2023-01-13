@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Call Tracker - Edit #'.$trkEdit->id)
@section('css')
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@stop
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
        <h1> Call Tracker Edit # {{$trkEdit->id}}</h1>  
        <a href="{{route('moduurn.calltracker.index')}}" class="btn btn-moduurn" type="button" title="return">
            <i class="fas fa-undo"></i>
        </a>
    </div>
@stop
@section('content')
    {!! Form::model($trkEdit, ['route' => ['moduurn.calltracker.update', $trkEdit->id], 'method' => 'PATCH']) !!}
        @include('moduurn.calltracker.partials.form')
    {!! Form::close() !!}
@stop
