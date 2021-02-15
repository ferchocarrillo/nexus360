@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Users')

@section('content_header')
<h1 class="d-inline">Upload Users</h1>
@stop

@section('content')


<update-users-component :users='@json($data)' :roles='@json($roles)'></update-users-component>



@stop