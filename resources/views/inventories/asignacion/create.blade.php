@extends('adminlte::page')
@section('title_postfix', ' | Adquisiciones')
@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Kaizen.css') }}">
@stop
@section('content_header')
    <h1>Asignación</h1>
@stop
@section('content')
    <form action="{{ url('inventories/adquisicion') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" style="height: 60px; " data-toggle="modal"
                            data-target="#modalEspecificaciones">
                            Click aqui para seleccionar Articulos
                        </button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalEspecificaciones" tabindex="-1" role="dialog"
                aria-labelledby="modalEspecificacionesTitulo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEspecificacionesTitulo">Especificaciones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{ Form::label('grupo', 'Articulos') }}
                                        {{ Form::select('grupo', $articulos, null, ['placeholder' => '--', 'class' => 'custom-select ' . ($errors->has('grupo') ? 'is-invalid' : ''), 'required']) }}
                                        @include('errors.errors', ['field' => 'grupo'])
                                        <hr>
                                        <div class="form-group" id="datosArticulo"></div>
                                        <div class="col-sm-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    {{ Form::label('cantidad', 'Cantidad') }}
                                                    <input type="number" class="form-control" placeholder=""
                                                        name="cantidad" id="cantidad" aria-label="cantidad">
                                                    @include('errors.errors', ['field' => 'cantidad'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    {{ Form::label('observacion', 'Observación') }}
                                                    {{ Form::textarea('observacion', null, ['id' => 'observacion', 'class' => 'form-control', 'rows' => 3, 'style' => 'resize:none']) }}
                                                    @include('errors.errors', ['field' => 'observacion'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    {{ Form::label('precios', 'Precios') }}
                                                    {{ Form::number('precios', null, ['id' => 'precios', 'class' => 'form-control']) }}
                                                    @include('errors.errors', ['field' => 'precios'])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                            <button type="submit" id="printButton" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('motivo', 'Motivo de Asignación') }}
                        <input type="text" class="form-control" placeholder="" name="motivo" id="motivo"
                            aria-label="motivo">
                        @include('errors.errors', ['field' => 'motivo'])
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('fAsignacion', 'Fecha de Asignación') }}
                        <input type="date" class="form-control" placeholder="" name="fAsignacion" id="fAsignacion"
                            aria-label="fAsignacion">
                        @include('errors.errors', ['field' => 'fAsignacion'])
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('identificacion', 'Identificacion') }}
                        {{ Form::select('identificacion', $user_ids, null, ['placeholder' => '--', 'class' => 'custom-select ' . ($errors->has('identificacion') ? 'is-invalid' : ''), 'required']) }}
                        @include('errors.errors', ['field' => 'identificacion'])
                        <hr>
                        <div class="form-group" id="datosUsuarios"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('nombreAsignado', 'Nombre de Asignado') }}
                        <input type="text" class="form-control" placeholder="" name="nombreAsignado" id="nombreAsignado"
                            aria-label="nombreAsignado">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('cargo', 'Cargo de Asignado') }}
                        <input type="text" class="form-control" placeholder="" name="cargo" id="cargo" aria-label="cargo">
                        @include('errors.errors', ['field' => 'cargo'])
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('telefono', 'Telefono') }}
                        <input type="number" class="form-control" placeholder="" name="telefono" id="telefono"
                            aria-label="telefono">
                        @include('errors.errors', ['field' => 'telefono'])
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('campaña', 'Campaña') }}
                        <input type="text" class="form-control" placeholder="" name="campaña" id="campaña"
                            aria-label="campaña">
                        @include('errors.errors', ['field' => 'campaña'])
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('bodega', 'Bodega') }}
                        <select name="bodega" class="custom-select" required>
                            <option value selected disabled> -- </option>
                            @foreach ($bodegas as $bodega)
                                <option value="{{ $bodega->bodega }}">{{ $bodega->bodega }}</option>
                            @endforeach
                        </select>
                        @include('errors.errors', ['field' => 'bodega'])
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('cantidadStock', 'Cantidad en Stock') }}
                        <input type="number" class="form-control" placeholder="" name="cantidadStock" id="cantidadStock"
                            aria-label="cantidadStock">
                        @include('errors.errors', ['field' => 'cantidadStock'])
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::label('factura', 'Factura') }}
                        {{ Form::text('factura', null, ['id' => 'factura', 'class' => 'form-control']) }}
                        @include('errors.errors', ['field' => 'factura'])
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        {{ Form::checkbox('terminos', 'terminos y condiciones aqui', false, ['id' => 'terminos', 'class' => 'form-check-input']) }}
                        {{ Form::label('terminos', 'Terminos y Condiciones', ['id' => 'terminos', 'class' => 'form-control']) }}
                        @include('errors.errors', ['field' => 'terminos'])
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
        </div>
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#grupo').on('change', function(e) {
                var id = $('#grupo').val();
                if (id) {
                    $.ajax({
                        url: "{{ route('Articulo') }}",
                        data: "id=" + id + "&_token={{ csrf_token() }}",
                        //dataType: "json",
                        method: "POST",
                        success: function(result) {
                            $('#datosArticulo').html(result);
                            //$('#nombreEmpresa').val(result.nombreEmpresa);
                            //$('#empresa_id').append("<option value=''>nombre de la empresa</option>");
                            //$.each(result, function(index,value){
                            //    $('#empresa_id').append("<option value='"+value.nombreEmpresa+"'>"+value.nombreEmpresa+"</option>");
                            //});
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
        $('#identificacion').on('change', function(e) {
                var id = $('#identificacion').val();
                if (id) {
                    $.ajax({
                            url: "{{ route('Usuario') }}",
                            data: "id=" + id + "&_token={{ csrf_token() }}",
                            //dataType: "json",
                            method: "POST",
                            success: function(result) {
                                $('#buscarUsuario').html(result);
                                //$('#name').val(result.name);
                                //$('#username').val(result.username);
                                //$('#username').append("<option value=''>nombre usuario</option>");
                                //$.each(result, function(index,value){
                                // $('#identificacion').append("<option value='"+value.name+"'>"+value.name+"</option>");
                            });
                    }
                });
        }
        });
        });
    </script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
    <script>
        $('#save').click(function() {
            $select_value = $("#exampleSelect").value();
            $('#MyModal').modal('hide');
        });
    </script>
    <script language="Javascript">
        function imprimirSeleccion(nombre) {
            var ficha = document.getElementById(nombre);
            var ventimp = window.open(' ', 'popimpr');
            ventimp.document.write(ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }
    </script>
@endpush
