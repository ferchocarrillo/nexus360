@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Service Experts Files')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <img height="60px" src=" {{ asset('img/serviceexperts_logo.png') }}" title="CGM">

    {{-- <h1 class="mx-4 text-center">Service Experts</h1> --}}
</div>
@stop

@section('content')

<service-experts-file-component path_init="{{$path_init}}" :permissions=@json($permissions)></service-experts-file-component>




@stop
