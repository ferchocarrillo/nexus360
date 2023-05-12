@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Vendors')

@section('css')
{{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/kaizen.css')}}">
@stop

{{--  @section('content_header')
    <h1>Create New Suppliers</h1>
@stop  --}}

@section('content')
<form action="{{ url('inventories/proveedores/'.$proveedores->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    @csrf
    @method('PATCH')
<div class="row">
    <div class="col">

<label>Nit</label>
      <input type="number" class="form-control" placeholder="nit" name="nit" id="nit" aria-label="nit" value="{{old('nit', $proveedores->nit)}}">
    </div>
    <div class="col">
<label>Nombre de la Empresa</label>
      <input type="text" class="form-control" placeholder="Nombre de la Empresa" name="nombreEmpresa" id="nombreEmpresa" aria-label="Nombre de la Empresa" value="{{old('nombreEmpresa', $proveedores->nombreEmpresa)}}">
    </div>
    <div class="col">
        <label>Numero telefonico</label>
        <input type="number" class="form-control" placeholder="Telefono Empresa" name="telEmpresa" id="telEmpresa" aria-label="Telefono Empresa" value="{{old('telEmpresa', $proveedores->telEmpresa)}}">
      </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
          <label>Nombre del Asesor</label>
        <input type="text" class="form-control" placeholder=">Nombre del Asesor" name="nombreAsesor" id="nombreAsesor" aria-label=">Nombre del Asesor" value="{{old('nombreAsesor', $proveedores->nombreAsesor)}}">
      </div>
    <div class="col">
          <label>Correo</label>
      <input type="mail" class="form-control" placeholder="Correo" name="correo" id="correo" aria-label="correo" value="{{old('correo', $proveedores->correo)}}">
    </div>
    <div class="col">
          <label>Dirección</label>
      <input type="text" class="form-control" placeholder="Direccion" name="direccion" id="direccion" aria-label="direccion" value="{{old('direccion', $proveedores->direccion)}}">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
        <label>Descripción</label>
<input type="text" class="form-control" name="descripcion" id="descripcion" value="{{old('descripcion', $proveedores->descripcion)}}">



      </div>
    <div class="col">
        <label>Sitio Web</label>
      <input type="text" class="form-control" placeholder="Sitio Web" name="sitioWeb" id="sitioWeb" aria-label="sitioWeb" value="{{old('sitioWeb', $proveedores->sitioWeb)}}">
    </div>
    <div class="col">
        <label>Segmento</label>
      <input type="text" class="form-control" placeholder="Segmento" name="segmento" id="segmento" aria-label="segmento" value="{{old('segmento', $proveedores->segmento)}}">
    </div>
    <div class="col">
        <label>Estado</label>
        <input list="estado" type="text" name="estado"  class="form-control"   placeholder="" required>
        <datalist name="estado" id="estado" >
            <option value="{{old('estado', $proveedores->estado)}}"></option>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>

        </datalist>

      </div>
  </div>


<button class= "btn btn-primary float-right"><i class="fas fa-save"></i> Guardar</button>
</form>

@stop

