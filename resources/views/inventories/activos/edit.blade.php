@extends('adminlte::page')
@section('title_postfix', ' | Articulos')
@section('content_header')
    <h1>Editar Articulo</h1>
    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
                    Anular Producto
                    </button>
                    <button class="btn btn-primary float-right"><a href="/inventories/activos/articulos"
                        style="color: white;">Regresar</a></button>
@stop
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {!! Form::model($activo, ['route' => ['activos.update', $activo->id], 'method' => 'PUT']) !!}
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Atención</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Al seleccionar esta opcion este articulo se anulara de la base datos.</p>
                        </div>
                        <div class="modal-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="anulado" name="anulado" value="anulado">
                                <label class="form-check-label" for="anulado">Anular</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    @include('inventories.activos.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop


