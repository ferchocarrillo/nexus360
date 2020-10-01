@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Users')

@section('content_header')
<h1 class="d-inline">Create User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'users.store', 'method'=>'POST']) !!}
            @include('users.partials.form')
        {!! Form::close() !!}
    </div>
</div>
@stop
