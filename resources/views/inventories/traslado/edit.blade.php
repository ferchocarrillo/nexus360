@extends('adminlte::page')
@section('title_postfix', ' | Traslado')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Cambio de Bodega</h1>
    <button class="btn btn-primary float-right"><a href="/inventories/traslado" style="color: white;">Regresar</a></button>
@stop
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if ($activo->asignacion)
                        <strong>Articulo: </strong>{{ $activo->asignacion->articulo }}<br>
                        <strong>Asignado A: </strong>{{ $activo->asignacion->full_name }}<br>
                        <strong>Identificación: </strong>{{ $activo->asignacion->national_id }}<br>
                        <strong>Cargo: </strong>{{ $activo->asignacion->position }}<br>
                        <strong>Campaña: </strong>{{ $activo->asignacion->campaign }}<br>
                        <strong>Supervisor: </strong>{{ $activo->asignacion->supervisor }}<br>
                        <strong>Observación: </strong>{{ $activo->asignacion->observacion }}<br>
                        <strong>Wave: </strong>{{ $activo->asignacion->wave }}<br>
                    @else
                        <strong>Activo no asignado</strong><br>
                    @endif
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">


                {!! Form::model($activo, ['route' => ['traslado.update', $activo->id], 'method' => 'PATCH']) !!}




                    {{-- <form action="{{ url('inventories/traslado/' . $activo->id) }}" method="POST"
                        enctype="multipart/form-data" class="form-horizontal"> --}}
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="form-group">

                            {{ Form::label('bodega', 'Bodega') }}
                            {{ Form::select('bodega', $bodegas, null, ['placeholder' => '--', 'class' => 'custom-select ' . ($errors->has('bodega') ? 'is-invalid' : ''), 'required']) }}
                            @include('errors.errors', ['field' => 'bodega'])
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-people-carry"></i> Trasladar</button>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>




    @stop
