@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Roles')

@section('content_header')
<h1 class="d-inline">Role</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
    <p><strong>Name</strong> {{ $role->name }}</p>
    <p><strong>Slug</strong> {{ $role->slug }}</p>
    <p><strong>Description</strong> {{ $role->description }}</p>
    </div>
</div>
@stop