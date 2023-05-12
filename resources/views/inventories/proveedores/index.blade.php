@extends('adminlte::page')
@section('title_postfix', ' | Proveedores')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
@stop
@section('content_header')
@can('haveaccess','proveedores.create')
<a href="{{route('proveedores.create')}}" class="btn btn-primary float-right">Registrar Nuevos Proveedores</a>
@endcan
    <h1>Lista de Proveedores</h1>

@stop
@section('content')
<form action="{{ url('inventories/proveedores')}}"method="POST" enctype="multipart/form-data" class="form-horizontal">
    <div class="container">
        <div class="pull-right">
            <div class="col-md-12">
                <div class="card" style="background:transparent;">
    <table class="table-index" id="vendorsTable">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Telefono</th>
        <th scope="col">Latitud</th>
        <th scope="col">Longitud</th>
        <th scope="col">Ruta</th>
        <th colspan="3"></th>

    </tr>
    @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente->id}}</td>
            <td>{{$cliente->documento}}</td>
            <td>{{$cliente->nombres}}</td>
            <td>{{$cliente->apellidos}}</td>
            <td>{{$cliente->telefono}}</td>
            <td>{{$cliente->latitud}}</td>
            <td>{{$cliente->longitud}}</td>
            <td>{{$cliente->ruta}}</td>
            <td>

                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
</form>
@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
<script>
    $(document).ready(function(){
$('#vendorsTable').DataTable();
    })
</script>
    @endpush
