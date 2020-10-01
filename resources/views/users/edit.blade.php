@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Users')

@section('content_header')
<h1 class="d-inline">Edit User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($user, ['route' => ['users.update', $user->id],
        'method' => 'PUT']) !!}
            @include('users.partials.form')
        {!! Form::close() !!}
    </div>
</div>
@stop
