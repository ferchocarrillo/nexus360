@extends('adminlte::page')
@section('title_postfix', ' | Inactivos')
@section('content')
@section('content_header')
    <h1 class="d-inline">Lista de Articulos Inactivos</h1>
    <button class="btn btn-primary float-right"><a href="/inventories/activos/articulos"
            style="color: white;">Regresar</a></button>
@stop
@section('content')
    <form action="{{ url('inventories/inactivos') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="pull-right">
                <div class="col-md-12">
                    <div class="card" style="background:transparent;">
                        <table class="table-index" id="vendorsTable" style="font-size: 14px; ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Codigo</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                                @foreach ($activos as $activo)
                                    <tr>
                                        <td>{{ $activo->id }}</td>
                                        <td>{{ $activo->articulo }}</td>
                                        <td>{{ $activo->codigo }}</td>
                                        <td>
                                            <form action="{{ url('/inventories/inactivos/' . $activo->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('/inventories/inactivos/' . $activo->id . '/edit') }}"
                                                    class="btn btn-success" role="button" aria-pressed="true">Editar</a>
                                                @can('haveaccess', 'inventories/inactivos.delete')
                                                    <button class="btn btn-warning btn-sm" onclick="return confirm('Borrar?');"
                                                        type="submit" aria-pressed="true">Borrar</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    @stop
</form>
