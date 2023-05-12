@extends('adminlte::page')
@section('title_postfix', ' | Asignación')
@section('content_header')
    <h1>Asignar Activos</h1>
@stop
@section('content')
    <form action="{{ url('inventories/asignacion/' . $asignado->id) }}" method="POST" enctype="multipart/form-data"
        class="form-horizontal">
        @csrf
        @method('PATCH')
        <h5>Datos del Articulo</h5>
        <div class="row">
            <div class="col">
                <label>Codigo</label>
                <input type="text" class="form-control" placeholder="codigo" name="codigo" id="codigo" aria-label="codigo"
                    value="{{ old('codigo', $asignado->codigo) }}">
            </div>
            <div class="col">
                <label>Articulo</label>
                <input type="text" class="form-control" placeholder="articulo" name="articulo" id="articulo"
                    aria-label="articulo" value="{{ old('articulo', $asignado->articulo) }}">
            </div>
            <div class="col">
                <label>Atributos</label>
                <input type="text" class="form-control" placeholder="atributos" name="atributos" id="atributos"
                    aria-label="atributos" value="{{ old('atributos', $asignado->atributos) }}">
            </div>
            <div class="col">
                <label>Atributos</label>
                <input type="text" class="form-control" placeholder="estado" name="estado" id="estado" aria-label="estado"
                    value="{{ old('estado', $asignado->estado) }}">
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                {{ Form::label('responsable', 'Responsable') }}
                {{ Form::select('responsable', $usuarios, null, ['placeholder' => '--', 'class' => 'inpArticulo custom-select ' . ($errors->has('responsable') ? 'is-invalid' : ''), 'required']) }}
                @include('errors.errors', ['field' => 'responsable'])
                <hr>
                <div class="form-group" id="datosResponsable"></div>
            </div>
        </div>
        </div>
        <button class="float-right"><i class="fas fa-save"></i>Guardar</button>
    </form>
@stop
<script lenguaje:"JavaScript">
    $(document).ready(function() {
                $('#responsable').on('change', function(e) {
                    $('#datosResponsable').html('');
                    var id = $('#responsable').val();
                    if (id) {
                        $.ajax({
                            url: "{{ url('asignacion.buscarResponsable') }}",
                            data: "id=" + id + "&_token={{ csrf_token() }}",
                            //dataType: "json",
                            method: "POST",
                            success: function(result) {
                                //
                                $('#datosResponsable').html(result);
                                /$('#nombreEmpresa').val(result.nombreEmpresa);
                                $('#empresa_id').append(
                                    "<option value=''>nombre de la empresa</option>");
                                $.each(result, function(index, value) {
                                    $('#empresa_id').append("<option value='" + value
                                        .nombreEmpresa + "'>" + value.nombreEmpresa +
                                        "</option>");
                                });
                            }
                        });
                    }
                });
</script>
