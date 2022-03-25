@extends('adminlte::page')

@section('title_postfix', ' | Trivia Create')

@section('content_header')
    <h1 class='d-inline'>Trivia Create</h1>
@stop
@section('content')
    <trivia-component action="create" :min-questions="2" ></trivia-component>
@stop
