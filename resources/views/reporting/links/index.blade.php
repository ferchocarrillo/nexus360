@extends('adminlte::page')
@section('title_postfix', ' | Index Report')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} ">
@stop
@section('content_header')
    <h1 class="d-inline">Lista de Campañas Registradas</h1>
    <a href="{{ url('reporting/links/create') }}" class="btn btn-primary float-right">
        <i class="fas fa-plus"></i>
        &nbsp;&nbsp;Nueva Campaña
    </a>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="activosTable">
                <thead>
                    <tr>
                        <th scope="col">Report</th>
                        <th scope="col">Campaign</th>
                        <th scope="col">Name</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Actions</th>
                    </tr>
                <tbody>
                    @foreach ($links as $link)
                        <tr>
                            <td>{{ $link->report }}</td>
                            <td>{{ $link->campaign }}</td>
                            <td>{{ $link->name }}</td>
                            <td style="width: 150px;"><img src="{{ asset('storage/' . $link->logo) }}" alt="" width="50%">
                            </td>
                            <td><a href="{{ url('/reporting/links/' . $link->id . '/edit') }}" class="btn btn-success"
                                    role="button" aria-pressed="true" title="editar"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#activosTable').DataTable({
                language: {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    search: `<div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>`,
                    searchPlaceholder: 'Buscar...',
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                }
            });
        })
    </script>
@endpush
