@extends('adminlte::page')

@section('title_postfix', ' | Trivias Admin')

@section('content_header')
    <h1 class='d-inline'>Trivias Admin</h1>
    <a href="/trivias/create" class="btn btn-primary float-right">Create</a>
@stop
@section('content')
    <div class='card'>
        <div class='card-body'>
            <trivia-admin-component :trivias='@json($trivias)'></trivia-admin-component>
        </div>
    </div>
@stop
