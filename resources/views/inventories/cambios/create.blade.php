@extends('adminlte::page')
@section('title_postfix', ' | Bajas')
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/Kaizen.css')}}">
@stop
@section('content_header')
    <h1>Cambios y Reemplazos en Stock</h1>
@stop
@section('content')
<form action="{{ url('inventories/cambios')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
    {{csrf_field()}}

    {{--beging modal--}}
    {{--
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" style="height: 60px; " data-toggle="modal" data-target="#modalEspecificaciones">
                    Click aqui para seleccionar Articulos
                    </button>
                </div>
            </div>
        </div>
    <!-- Modal -->
    <div class="modal fade" id="modalEspecificaciones" tabindex="-1" role="dialog" aria-labelledby="modalEspecificacionesTitulo" aria-hidden="true">
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
                                {{ Form::select('grupo',$articulos, null ,['placeholder' => '--','class' => 'custom-select ' . ($errors->has('grupo') ? 'is-invalid' : '' ),'required']) }}
                                @include('errors.errors', ['field' => 'grupo'])
                                <hr>
                                <div class="form-group" id="datosArticulo"></div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                        <button type="submit"  id="printButton" class="btn btn-primary">Guardar Cambios</button>
                    </div>
            </div>
        </div>
    </div>
    </div>
    --}}
    {{--end modal--}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('motivoCambio', 'Motivo de Cambio') }}
                                <input type="text" class="form-control" placeholder="" name="motivoCambio" id="motivCambioa" aria-label="motivoCambio" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('justCambio', 'Justifiación de Cambio') }}
                                <input type="text" class="form-control" placeholder="" name="justCambio" id="justCambio" aria-label="justCambio" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('fCambio', 'Fecha de Cambio') }}
                                <input type="date" class="form-control" placeholder="" name="fCambio" id="fCambio" aria-label="fCambio" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('user_id', 'Identificacion') }}
                                <input type="number" class="form-control" placeholder="" name="user_id" id="user_id" aria-label="user_id" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('ultimoAsignado', 'Ultimo Asignado') }}
                                <input type="text" class="form-control" placeholder="" name="ultimoAsignado" id="ultimoAsignado" aria-label="ultimoAsignado" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                            {{ Form::label('cargoultimoAsignado', 'Cargo de Ultimo Asignado') }}
                            <input type="text" class="form-control" placeholder="" name="cargoultimoAsignado" id="cargoultimoAsignado" aria-label="cargo" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::label('telefono', 'Telefono') }}
                                <input type="number" class="form-control" placeholder="" name="telefono" id="telefono" aria-label="telefono" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('wave','Wave')}}
                                <input type="text" class="form-control" placeholder="" name="wave" id="wave" aria-label="wave" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('bodega','Bodega')}}
                                <select name="bodega" class="custom-select"  required>
                                <option value selected disabled> -- </option>
                                @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->bodega}}">{{ $bodega->bodega }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('cantidad','Cantidad')}}
                                <input type="number" class="form-control" placeholder="" name="cantidad" id="cantidad" aria-label="cantidad" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('cantidadStock','Cantidad en Stock')}}
                                <input type="number" class="form-control" placeholder="" name="cantidadStock" id="cantidadStock" aria-label="cantidadStock" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('observacion','Observación')}}
                                {{Form::textarea('observacion', NUll, ['id' => 'observacion','class'=>'form-control' ,'rows' => 3, 'style' => 'resize:none'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::label('precios','Precios Standard')}}
                                <input type="number" class="form-control" placeholder="" name="precios" id="precios" aria-label="precios" >
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                {{Form::checkbox('AutDescuent','Autorizacion de Descuento', false,  ['id' => 'AutDescuent','class'=>'form-check-input'])}}
                                {{Form::label('AutDescuent','Autorizacion de Descuento',['id' => 'AutDescuent','class'=>'form-control'])}}
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
            if (id){
        $.ajax({
            url: "{{ route('Articulo')}}",
            data: "id="+id+"&_token={{ csrf_token()}}",
             //dataType: "json",
            method: "POST",
            success: function(result)
            {
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
                    $('#myModal').on('shown.bs.modal', function () {
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
                    ventimp.document.write( ficha.innerHTML );
                    ventimp.document.close();
                    ventimp.print( );
                    ventimp.close();
                    }
                    </script>
    @endpush
