@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Appointment Tracker')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <img height="70px" src=" {{ asset('img/CGM_Logo Hires.png') }}" title="CGM">
    <h1 class="mx-4 text-center">Appointment Tracker</h1>
    <img height="70px" src=" {{ asset('img/Seven[x]_Logo_textBlue.png') }}" title="Seven[x]">
</div>
@stop

@section('content')

<div class="card">
    <div class="card-body">



@isset($dataCall)
{!! Form::open(['route'=>'cgm.appointmenttracker.store','method'=>'POST']) !!}
@include('CGM.partials.form')
{!! Form::close() !!}

@else
<form action="{{ route('cgm.appointmenttracker.search') }}" method="POST">
    @csrf
    <input name="CallID" type="number"  class="form-control {{$errors->has('CallID') ? 'is-invalid' : ''}}" placeholder="Call ID" autofocus >
    @include('errors.errors',['field'=> 'CallID'])

</form>
@endisset

</div>
</div>

@stop

@push('js')

@endpush