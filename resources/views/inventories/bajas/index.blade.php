@extends('adminlte::page')
@section('title_postfix', ' | Bajas')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Bajas de Stock</h1>
@stop
@section('content')
    <form action="{{ url('inventories/bajas') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-14">
                    <div class="card-1">
                        <div class="card-header">Activos Asigandos</div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Codigo Articulo</th>
                                        <th scope="col">Nombre Responsable</th>
                                        <th scope="col">Identificacion</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Campaña</th>
                                        <th scope="col">Supervisor</th>
                                        <th colspan="3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignados as $asignado)
                                        <tr>
                                            <td>{{ $asignado->articulo }}</td>
                                            <td style="text-transform: capitalize;">{{ $asignado->full_name }}</td>
                                            <td>{{ $asignado->national_id }}</td>
                                            <td>{{ $asignado->position }}</td>
                                            <td>{{ $asignado->campaign }}</td>
                                            <td>{{ $asignado->supervisor }}</td>
                                            <td> <a href="{{ url('/inventories/bajas/' . $asignado->id . '/edit') }}"
                                                    class="btn btn-success btn-sm" role="button"
                                                    aria-pressed="true">Modificar</a> </td>
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
    @section('js')
        <script>
            Swal.fire(
                'Bajas de Stock',
                'Lista de registros',
                'success'
            )
        </script>
    @stop
@endsection
