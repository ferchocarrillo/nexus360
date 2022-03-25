@extends('adminlte::page')

@section('title_postfix', ' | Trivias')

@section('content_header')
    <h1 class='d-inline'>{{ $trivia->name }}</h1>
@stop
@section('content')
    <trivia-play-component :trivia="{{$trivia}}" />
@stop