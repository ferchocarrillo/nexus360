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
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="tablaActivos">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Campaign</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Required By</th>
                                    <th scope="col">Status</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kaizens as $key => $kaizen)
                                    <tr>
                                        <td>{{ $kaizen->id }}</td>
                                        <td>{{ $kaizen->title }}</td>
                                        <td>{{ $kaizen->campaign }}</td>
                                        <td>{{ $kaizen->group }}</td>
                                        <td>{{ $kaizen->type }}</td>
                                        <td>{{ $kaizen->description }}</td>
                                        <td>{{ $kaizen->required->name }}</td>
                                        <td>{{ $kaizen->status }}</td>
                                        <td>
                                            <a href="{{ url('/developers/testLab/create') }}" class="btn btn-success btn-sm"
                                                role="button" aria-pressed="true">Create Test</a>
                                            <a href="{{ url('/developers/testLab/' . $kaizen->id . '/edit') }}"
                                                class="btn btn-success btn-sm" role="button" aria-pressed="true">Edit
                                                Test</a>
                                        </td>
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
