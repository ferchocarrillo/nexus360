@extends('adminlte::page')
@section('title_postfix', ' | Bajas')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Reintegro o Descarga en Stock</h1>
    <button class="btn btn-primary float-right"><a href="/inventories/bajas" style="color: white;">Regresar</a></button>
@stop

@section('content')

    @can('haveaccess', invBajaStock::class)
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <div class="form-group row">
                        <label for="articulo" class="col-sm-2 col-form-label col-form-label-sm">Codigo Articulo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="articulo" placeholder="col-form-label-sm"
                                value="{{ old('articulo', $activo->codigo) }}" readonly>
                        </div>
                    </div>
                    @if ($activo->id_asignacion)
                        <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label col-form-label-sm">Nombre Responsable</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="full_name"
                                    placeholder="col-form-label-sm"
                                    value="{{ old('full_name', $activo->asignacion->full_name) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="col-sm-2 col-form-label col-form-label-sm">Cargo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="position" placeholder="Cargo"
                                    value="{{ old('position', $activo->asignacion->position) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-sm-2 col-form-label col-form-label-sm">Telefono</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control form-control-sm" id="telefono" placeholder="Telefono"
                                    value="{{ old('phone_number', $activo->asignacion->phone_number) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wave" class="col-sm-2 col-form-label col-form-label-sm">Wave</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="wave" placeholder="Wave"
                                    value="{{ old('wave', $activo->asignacion->wave) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="site" class="col-sm-2 col-form-label col-form-label-sm">Site</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="site" placeholder="Site"
                                    value="{{ old('site', $activo->asignacion->site) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="observacion" class="col-sm-2 col-form-label col-form-label-sm">Observación
                                Previa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="observacion"
                                    placeholder="col-form-label-sm"
                                    value="{{ old('observacion', $activo->asignacion->observacion) }}" readonly>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <h3 class="text-danger">El artículo no está asignado</h3>
                        </div>
                    @endif
                </ul>
            </div>
        </div>
        <form action="{{ url('inventories/bajas') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" id="id_adquisicion" name="id_adquisicion" value="{{ $activo->id }}">
            @if ($errors->has('id_adquisicion'))
                <span class="text-danger" role="alert">{{ $errors->first('id_adquisicion') }}</span>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ Form::label('motivo', 'Motivo de la Baja') }}</h5>
                            <p class="card-text">
                                {{ Form::select('motivo', $bajas, null, ['placeholder' => '--', 'class' => 'inpArticulo custom-select ' . ($errors->has('motivo') ? 'is-invalid' : ''), 'required']) }}
                                @include('errors.errors', ['field' => 'motivo'])
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ Form::label('observacion', 'Descripcion') }}</h5>
                            <p class="card-text">
                                {{ Form::textarea('observacion', null, ['placeholder' => 'Max 250 caracteres', 'cols' => 10, 'rows' => 3, 'maxlength' => 250, 'class' => 'inpArticulo form-control ' . ($errors->has('observacion') ? 'is-invalid' : ''), 'required']) }}
                                @include('errors.errors', ['field' => 'observacion'])
                            </p>
                            <input class="btn btn-lg btn-primary" type="submit" value="Registrar Cambios">
                        </div>
                    </div>
                </div>
        </form>
        </div>
    @endcan
@stop
