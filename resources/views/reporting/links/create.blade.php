@extends('adminlte::page')

@section('title_postfix', ' | Create New Report')

@section('content_header')
    <h1 class="d-inline">Nuevo Registro</h1>
@stop
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@section('content')
    <form action="{{ url('reporting/links') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="form-group">
                    <div class="col-12">
                        {{ Form::label('report', 'Report') }}
                        {{ Form::select('report', $report, null, ['placeholder' => '--', 'class' => 'custom-select' . ($errors->has('report') ? 'is-invalid' : ''), 'required']) }}
                    </div>
                </div>
                <div class="form-group" id="select_div">
                    <div class="col-12">
                        {{ Form::label('campaignOld', 'Campaign') }}
                        {{ Form::select('campaignOld', $campaign , null, ['onchange' => 'editor()', 'placeholder' => '--', 'class' => 'custom-select' . ($errors->has('campaignOld') ? 'is-invalid' : ''), 'required']) }}
                    </div>
                </div>
                    <div class="form-group" id="hidden_div" style="display: none">
                        <div class="col-8">
                            {{ Form::label('nuevaCampa', 'Ingresela aqui') }}
                            {{ Form::text('nuevaCampa', null, ['class' => 'form-control ' . ($errors->has('nuevaCampa') ? 'is-invalid' : '')]) }}
                        </div>
                    </div>
                <div class="form-group">
                    <div class="col-12">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : '')]) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-12">
                        {{ Form::label('url', 'Url') }}
                        {{ Form::text('url', null, ['class' => 'form-control ' . ($errors->has('url') ? 'is-invalid' : '')]) }}
                    </div>
                </div>
                <div class="form-group" id="logo_div" style="display: none">
                    <div class="col-12">
                        {{ form::label('logo', 'Logo') }}
                        {{ Form::file('logo', null, ['class' => 'form-control ', 'accept'=> '.png' . ($errors->has('logo') ? 'is-invalid' : '')]) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-8">
                    {{ Form::submit('Guardar Campaña', ['class' => 'btn btn-sm btn-primary']) }}
                </div>
            </div>
        </div>
    </form>

@stop
@push('js')
    <script>
        function editor() {
            var opcion = $('#campaignOld').val();
            if (opcion == 'Nueva Campaña') {
                $('#hidden_div').show();
                $('#logo_div').show();
            } else {
                $('#select_div').show();
                $('#hidden_div').hide();
                $('#logo_div').hide();
            }
        }
    </script>
@endpush
