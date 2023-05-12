@extends('adminlte::page')
@section('title_postfix', ' | Consultas')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />


    <style>
        .inputs-1 {
            border-radius: 0.75rem;
            display: block;
            width: 300px;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            text-transform: capitalize;
            margin-left: 4rem;
        }

        .buscador {
            color: aliceblue;
            background: rgb(8, 147, 240);
            width: auto;
            height: 35px;
            border-radius: 0.75rem;
            font-size: 18px;
        }

    </style>
@stop


@section('content_header')
    <h1>Panel de Consultas</h1>
@stop
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <h6>Total Activos Registrados: {{ $inv2->total() }}</h6>
                <div class="row my-5 d-flex justify-content-end">
                    <form action="/searchArchivos" method="GET">
                        <div class="input-group">
                            <input type="search" name="searchArchivos" id="searchArchivos" class="inputs-1"
                                class="inputs-1">
                            <span class="input-group-prepend">
                                <button type="submit" class="buscador"><i class="fas fa-search"></i> Articulos por
                                    Codigo</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 d-flex justify-content-start">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="tablaActivos">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Bodega</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Tipo de Requerimiento</th>
                                    <th scope="col">NIT</th>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Numero de Factura</th>
                                    <th scope="col">Descripcion</th>
                                    <th colspan="3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inv2 as $inventario)
                                    <tr>
                                        <td>{{ $inventario->codigo }}</td>
                                        <td>{{ $inventario->bodega }}</td>
                                        <td>{{ $inventario->estado }}</td>
                                        <td>{{ $inventario->tipo_requerimiento }}</td>
                                        <td>{{ $inventario->nit }}</td>
                                        <td>{{ $inventario->articulo }}</td>
                                        <td>{{ $inventario->n_factura }}</td>
                                        <td>{{ $inventario->descripcion }}</td>
                                        <td>
                                            <form action="{{ url('/inventories/bajas/' . $inventario->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('/inventories/bajas/' . $inventario->id . '/edit') }}"
                                                    class="btn btn-success btn-sm" role="button"
                                                    aria-pressed="true">Modificar</a>
                                                <button class="btn btn-warning btn-sm" onclick="return confirm('Borrar?');"
                                                    type="submit" aria-pressed="true">&nbsp;&nbsp;&nbsp;Borrar&nbsp;&nbsp;
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $inv2->links() }}
                </div>
            </div>
        </div>
        <div class="row my-5 d-flex justify-content-start">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cantidad_articulos as $canti)
                                    <tr>
                                        <td>{{ $canti->articulo }}</td>
                                        <td>{{ $canti->cant }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



@push('js')
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js') }} "></script>
    <script>

        $(document).ready(function(){

            $('#tablaActivos').DataTable();

        })

    </script>
@endpush
