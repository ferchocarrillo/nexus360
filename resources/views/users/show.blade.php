@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Users')

@section('content_header')
<h1 class="d-inline">User</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
    <p><strong>ID</strong> {{ $user->id }}</p>
    <p><strong>Name</strong> {{ $user->name }}</p>
    <p><strong>Username</strong> {{ $user->username }}</p>
    <p><strong>Email</strong> {{ $user->email }}</p>
    </div>
</div>
@stop