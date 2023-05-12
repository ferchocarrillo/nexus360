@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Activos')

@section('content_header')
<h1 class="d-inline">Crear Articulo</h1>
<button class="btn btn-primary float-right"><a href="/inventories/activos/articulos" style="color: white;">Regresar</a></button>
@stop

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'activos.store', 'method'=>'POST']) !!}
                    @include('inventories.activos.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
