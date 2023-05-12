<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@extends('adminlte::page')
@section('title_postfix', ' | Articulos')
@section('content_header')
    <h1>Reactivar Articulo</h1>
    <button class="btn btn-primary float-right"><a href="/inventories/activos/articulos"
        style="color: white;">Regresar</a></button>
@stop
@section('content')
{!! Form::model($activos, ['route' => ['activos.update', $activos->id], 'method' => 'PUT']) !!}
@include('inventories.inactivos.form')
{!! Form::close() !!}

@stop


