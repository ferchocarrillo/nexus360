@extends('adminlte::page')
{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Kaizen')

@section('css')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/kaizen.css')}}">
@stop

@section('content_header')
<h1 class="d-inline">Kaizen <span class="kaizen">改善</span></h1>
<div class="float-right">
    <a href="/kaizen" class="btn btn-outline-primary" type="button" >View All</a>
</div>
@stop

@section('content')
    
    <kaizen-component 
        :groups=@json($groups)
        :campaigns='@json($campaigns)'
        :types=@json($types)
        :schedules='@json($schedules)'
        :employess='@json($employess)'
    ></kaizen-component>

    {{-- :campaigns="{{$campaigns}}" :types="{{$types}}" :schedules="{{$schedules}}" --}}

    
@stop

