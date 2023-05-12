@extends('adminlte::page')
@section('title_postfix', ' | Articulos')
@section('content')
@section('content_header')
<h1 class="d-inline">Lista de Activos Fijos</h1>
@can('haveaccess','inactivos.index')
<a href="{{route('inactivos.index')}}"
    class="btn btn-primary float-right"
    >Ver Inactivos
</a>
@endcan  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
@can('haveaccess','activos.create')
<a href="{{route('activos.create')}}"
    class="btn btn-primary float-right"
    >Nuevos Activos
</a>
@endcan


@stop
@section('content')

<form action="{{ url('inventories/activos/show')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}
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
            <td>{{$activo->id}}</td>
            <td>{{$activo->articulo}}</td>
            <td>{{$activo->codigo}}</td>
            <td>
        <form action="{{url('/inventories/activos/'.$activo->id)}}" method="post">
                @csrf
                @method('DELETE')
            <a href="{{url('/inventories/activos/'.$activo->id.'/edit')}}" class="btn btn-success" role="button" aria-pressed="true">Editar</a>

            @can('haveaccess','inventories/activos.delete')
            <button class="btn btn-warning btn-sm" onclick="return confirm('Borrar?');" type="submit"aria-pressed="true">Borrar</button>
            @endcan


        </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @stop
        </form>


