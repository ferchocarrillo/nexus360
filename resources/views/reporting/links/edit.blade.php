@extends('adminlte::page')

@section('title_postfix', ' | Create New Report')

@section('content_header')
    <h1 class="d-inline">Editar Registros</h1>
@stop
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@section('content')

{!! Form::model($link, ['route' => ['links.update', $link->id],'method' => 'PUT', 'enctype'=> "multipart/form-data"]) !!}
    <div class="container">
        <div class="row">
            <div class="form-group">
                <div class="col-12">
                    {{ Form::label('report', 'Report') }}
                    {{ Form::text('report', $link->report, null, ['class' => 'form-control' . ($errors->has('report') ? 'is-invalid' : ''), 'required']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-12">
                    {{ Form::label('campaing', 'Campaing') }}
                    {{ Form::text('campaing', $link->campaign, null, ['class' => 'form-control' . ($errors->has('campaing') ? 'is-invalid' : ''), 'required']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-12">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', $link->name, null, ['class' => 'form-control' . ($errors->has('name') ? 'is-invalid' : ''), 'required']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-16">
                    {{ Form::label('url', 'Url') }}
                    {{ Form::text('url', $link->url, null, ['class' => 'form-control ' . ($errors->has('url') ? 'is-invalid' : ''), 'required']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group" id="logo_div" >
                <div class="col-8">
                    {{ form::label('logo', 'Logo actual') }}
                    <img src="{{ asset('storage/' . $link->logo) }}" alt="" width="30%">
                </div>
            </div>

            <div class="col-12">
            <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()" />
            {{ form::label('imgChange', 'Si desea cambiar el logo seleccione esta opción') }}
        </div>

            <div class="form-group" id="hidden_div" style="display: none">
                <div class="col-12">
                    {{ form::label('logo', 'Logo ') }}
                    {{ Form::file('logo', null, ['class' => 'form-control ', 'acept' . ($errors->has('logo') ? 'is-invalid' : '')]) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-8">
                {{ Form::submit('Guardar Campaña', ['class' => 'btn btn-sm btn-primary']) }}
            </div>
        </div>
    </div>
    <hr>
    {!! Form::close() !!}



    @push('js')
        <script>
            function showContent() {
                element = document.getElementById("hidden_div");
                imagen = document.getElementById("logo_div");
                check = document.getElementById("check");
                if (check.checked) {
                    element.style.display='block';
                    imagen.style.display = 'none';

                }
                else {
                    element.style.display='none';
                    imagen.style.display = 'block';
                }
            }
        </script>
    @endpush
@stop
