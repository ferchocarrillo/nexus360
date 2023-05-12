@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Proveedores')

@section('css')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/kaizen.css')}}">
@stop

@section('content_header')
    <h1>Registro de Nuevos Proveedores</h1>
    <button class="btn btn-primary float-right"><a href="/inventories/proveedores" style="color: white;">Regresar</a></button>
@stop

@section('content')
<form action="{{ url('inventories/proveedores')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}
<div class="row">
    <div class="col">
      <input type="number" class="form-control" placeholder="Nit" name="Nit" id="Nit" aria-label="Nit" required>
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Nombre de la empresa" name="nombreEmpresa" id="nombreEmpresa" aria-label="nombreEmpresa" required>
    </div>
    <div class="col">
        <input type="number" class="form-control" placeholder="Telefono empresa" name="telEmpresa" id="telEmpresa" aria-label="Telefono empresa" required>
      </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
        <input type="text" class="form-control" placeholder="Nombre del asesor" name="nombreAsesor" id="nombreAsesor" aria-label="Nombre del asesor" required>
      </div>
    <div class="col">
      <input type="mail" class="form-control" placeholder="correo" name="correo" id="correo" aria-label="correo" required>
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Direccion" name="direccion" id="direccion" aria-label="direccion" required>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
        <textarea  class="form-control" name="descripcion" id="descripcion" cols="3" rows="1" placeholder="Descripción" required></textarea>

      </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Sitio Web" name="sitioWeb" id="sitioWeb" aria-label="sitioWeb" required>
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Segmento" name="Segmento" id="Segmento" aria-label="Segmento" required>
    </div>


        <input type="hidden" class="form-control" placeholder="Estado" name="estado" id="estado" aria-label="estado" value="Active">

  </div>
  <br>
  <div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>
</form>

@stop
