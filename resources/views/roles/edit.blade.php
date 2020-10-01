@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Roles')

@section('content_header')
<h1 class="d-inline">Edit Role</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($role, ['route' => ['roles.update', $role->id],
        'method' => 'PUT']) !!}
            @include('roles.partials.form')
        {!! Form::close() !!}
    </div>
</div>
@stop
