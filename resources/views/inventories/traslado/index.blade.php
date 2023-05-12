@extends('adminlte::page')
@section('title_postfix', ' | Translado')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Traslado de Stock</h1>
@stop
@section('content')
    <form action="{{ url('inventories/traslado') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-14">
                    <div class="card-1">
                        <div class="card-header">Activos en stock</div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Bodega</th>
                                        <th scope="col">Estado de asignación</th>
                                        <th scope="col">Dado de baja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignados as $asignado)
                                        <tr>
                                            <td>{{ $asignado->articulo }}</td>
                                            <td>{{ $asignado->codigo }}</td>
                                            <td style="text-transform: capitalize;">{{ $asignado->bodega }}</td>
                                            {{-- <td>{{ $asignado->id_asignacion }}</td> --}}
                                            @if (empty( $asignado->id_asignacion))
                                            <td></td>
                                            @else
                                            <td> Asignado</td>
                                            @endif
                                            @if ( $asignado->baja)
                                            <td>Dado de baja</td>
                                            @else
                                            <td> </td>
                                            @endif
                                            {{-- <td>{{ $asignado->baja }}</td> --}}
                                            <td>
                                                <form action="{{ url('/inventories/traslado/' . $asignado->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('/inventories/traslado/' . $asignado->id . '/edit') }}"
                                                        class="btn btn-success btn-sm" role="button"
                                                        aria-pressed="true">Trasladar</a>
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="return confirm('Borrar?');" type="submit"
                                                        aria-pressed="true">&nbsp;Borrar&nbsp;&nbsp;&nbsp;</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $asignados->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
