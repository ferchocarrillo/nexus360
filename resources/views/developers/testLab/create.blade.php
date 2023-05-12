@extends('adminlte::page')
@section('title_postfix', ' | Create Develpers Test')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/developers.css') }}">
@stop
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <video class="logo" src="\video\developers\logo.3gp" width="300" height="220" autoplay="autoplay" loop="loop"
            muted defaultMuted playsinline oncontextmenu="return false;" preload="auto" id="miVideo"></video>
        <h1 class="title_h1">Developer Test Lab
            <br>
            Form Create
        </h1>
        <a href="/developer/testLab" class="btn btn-info" type="button" title="return"><i class="fas fa-undo"></i></a>
        </a>
    </div>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card_first">
                <div class="card-body">
                    <div class="card mb-0">
                        <div class="card-body">
                            {{--  <div class="mb-3">
                                <span class="span_label">*</span>
                                <span style="color: black">Required Fields</span>
                            </div>  --}}
                            <form action="/searchCases" method="GET">
                                <div class="input-group">
                                    <input type="search" name="searchCases" id="searchCases" class="inputs-1">
                                    <span class="input-group-prepend">
                                        <button type="submit" class="buscador">
                                            <i class="fas fa-search"></i>
                                            Cases by Code
                                        </button>
                                    </span>
                                </div>
                            </form>

                            <div class="container">
                                <div class="row my-5 d-flex justify-content-start">
                                    <div class="col-md-14">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-hover" id="tablaActivos">
                                                    <thead>
                                                        <tr>

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
                                                        @foreach ($kaizens as $ks)
                                                            <tr>

                                                                <td>{{ $ks->title }}</td>
                                                                <td>{{ $ks->group }}</td>
                                                                <td>{{ $ks->campaign }}</td>
                                                                <td>{{ $ks->type }}</td>
                                                                <td>{{ $ks->description }}</td>
                                                                <td>{{ $ks->required_by }}</td>
                                                                <td>{{ $ks->status }}</td>
                                                                <td>
                                                                    <form action="{{ url('/inventories/bajas/' . $ks->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="{{ url('/inventories/bajas/' . $ks->id . '/edit') }}"
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
                                            {{--  {{ $kaizens->links() }}  --}}
                                        </div>
                                    </div>
                                </div>







                            {!! Form::open(['route' => 'supportfacilitator.store', 'method' => 'POST']) !!}
                            {{--  <div class="row">
                                <div class="form-group col-md-6 col-lg-4">
                                    {{ Form::label('kaizen_case', 'Kaizen Case') }}<span class="span_label">*</span>
                                    {{ Form::select('kaizen_case', $kaizens, null, ['placeholder' => 'Select Kaizen Case', 'class' => 'custom-select  ' . ($errors->has('kaizen_case') ? 'is-invalid' : ''), 'id' => 'kaizen_case', 'required']) }}
                                </div>
                                <div>
                                    <span>Title</span>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
