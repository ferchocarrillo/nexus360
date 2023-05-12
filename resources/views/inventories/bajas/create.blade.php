@extends('adminlte::page')
@section('title_postfix', ' | Bajas')
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/Kaizen.css')}}">
@stop
@section('content_header')
    <h1>Bajas de Stock</h1>
@stop
@section('content')
<form action="{{ url('inventories/bajas')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}





    @stop
