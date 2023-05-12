@extends('adminlte::page')
@section('title_postfix', ' | Adquisiciones')
@section('content_header')
    <h1>Registro de Compras y Adquisiciones</h1>
@stop
@section('content')
    <form action="{{ url('inventories/adquisicion') }}" id="frmAdquisicion" method="POST" enctype="multipart/form-data"
        class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="from-group">
                                    {{ Form::label('n_factura', 'No. Factura') }}
                                    <input type="text" id="n_factura" name="n_factura" class="form-control" placeholder=""
                                        required>
                                    @include('errors.errors', ['field' => 'n_factura'])
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="from-group">
                                    {{ Form::label('tipo_entrada', 'Tipo de entrada') }}
                                    <select name="tipo_entrada" id="tipo_entrada" class="custom-select" required>
                                        <option value selected disabled> -- </option>
                                        @foreach ($tipos_de_entradas as $tipos)
                                            <option value="{{ $tipos->tipos }}">{{ $tipos->tipos }}</option>
                                        @endforeach
                                    </select>
                                    @include('errors.errors', ['field' => 'tipo_entrada'])
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="from-group">
                                    {{ Form::label('estado', 'Estado') }}
                                    <select name="estado" id="estado" class="custom-select" required>
                                        <option value selected disabled> -- </option>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->estado }}">{{ $estado->estado }}</option>
                                        @endforeach
                                    </select>
                                    @include('errors.errors', ['field' => 'estado'])
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="from-group">
                                    {{ Form::label('tipo_requerimiento', 'Tipo de Requerimiento') }}
                                    <select name="tipo_requerimiento" id="tipo_requerimiento" class="custom-select"
                                        required>
                                        <option value selected disabled> -- </option>
                                        @foreach ($requerimientos as $tipo)
                                            <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
                                        @endforeach
                                    </select>
                                    @include('errors.errors', ['field' => 'tipo_requerimiento'])
                                </div>
                            </div>
                            <div class="col-sm-3" id="numero_requerimiento_group" style="display: none">
                                <div class="from-group">
                                    {{ Form::label('numero_requerimiento', 'Numero Requerimiento') }}
                                    <input type="number" id="numero_requerimiento" name="numero_requerimiento"
                                        class="form-control" placeholder="">
                                    @include('errors.errors', ['field' => 'numero_requerimiento'])
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="from-group">
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
                            <div class="col-sm-3">
                                <div class="from-group">
                                    {{ Form::label('nit', 'NIT') }}
                                    {{ Form::select('nit', $nits, null, ['placeholder' => '--', 'class' => 'custom-select ' . ($errors->has('nit') ? 'is-invalid' : ''), 'required']) }}
                                    @include('errors.errors', ['field' => 'nit'])
                                    <hr>
                                    <div class="form-group" id="datosProveedor"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" data-toggle="modal" data-target="#modalEspecificaciones"
                                    class="btn btn-success" id="btnAdd">
                                    Agregar Activo
                                </button>
                            </div>
                        </div>
                        <tbody>
                            <hr>
                            <table class="table" id="art_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Articulo</th>
                                        <th>Atributos</th>
                                        <th>Costo unitario</th>
                                        <th>Cantidad</th>
                                        <th>Descripcion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
        </div>
    </form>
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
                        {{ Form::label('articulo', 'Articulos') }}
                        {{ Form::select('articulo', $articulos, null, ['placeholder' => '--', 'class' => 'inpArticulo custom-select ' . ($errors->has('articulo') ? 'is-invalid' : ''), 'required']) }}
                        @include('errors.errors', ['field' => 'articulo'])
                        <hr>
                        <div class="form-group" id="datosArticulo"></div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('cantidad', 'Cantidad') }}
                                <input type="number" class="inpArticulo form-control" placeholder="" name="cantidad"
                                    id="cantidad" aria-label="cantidad">
                                @include('errors.errors', ['field' => 'cantidad'])
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('costo_unitario', 'Costo unitario') }}
                                {{ Form::number('costo_unitario', null, ['id' => 'costo_unitario', 'class' => 'inpArticulo form-control']) }}
                                @include('errors.errors', ['field' => 'costo_unitario'])
                            </div>
                            <div class="col-md-12">
                                {{ Form::label('descripcion', 'Descripcion') }}
                                {{ Form::textarea('descripcion', null, ['id' => 'descripcion', 'class' => 'inpArticulo form-control', 'rows' => 3, 'style' => 'resize:none']) }}
                                @include('errors.errors', ['field' => 'descripcion'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                    <button type="button" id="agregarActivo" class="btn btn-primary">Agregar Activo</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var table = document.getElementById('art_table')
        function deleteRow(btn) {
            var i = btn.parentNode.parentNode.rowIndex;
            table.deleteRow(i);
        }
        function obtenerActivos() {
            var x = table.rows[0].cells.length
            var arr = new Array;
            for (var i = 1; i < table.rows.length; i++) {
                arr.push({
                    id: table.rows[i].cells[0].innerText,
                    articulo: table.rows[i].cells[1].innerText,
                    atributos: JSON.parse(table.rows[i].cells[2].getAttribute('data-json')),
                    cantidad: table.rows[i].cells[3].innerText,
                    costo_unitario: table.rows[i].cells[4].innerText,
                    descripcion: table.rows[i].cells[5].innerText
                })
            }
            return arr
        }
        $(document).ready(function() {
            $('#articulo').on('change', function(e) {
                $('#datosArticulo').html('');
                $('#cantidad').val('');
                $('#costo_unitario').val('');
                $('#descripcion').val('');
                var id = $('#articulo').val();
                if (id) {
                    $.ajax({
                        url: "{{ route('adquisicion.buscarArticulo') }}",
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
            $('#tipo_entrada').on('change', function() {
                var tEntrada = $(this).val();
                if (tEntrada == 'Nuevo hallazgo') {
                    // Cambio Estado
                    $('#estado option').each(function() {
                        if ($(this).val() != 'Usado') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#estado').val('Usado');
                    // Cambio tipo Requerimiento
                    $('#tipo_requerimiento option').each(function() {
                        if ($(this).val() != 'Ninguna') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#tipo_requerimiento').val('Ninguna');
                    $('#numero_requerimiento_group').hide();
                    $('#numero_requerimiento').val('');
                } else if (tEntrada == 'Nueva compra') {
                    $('#estado option').each(function() {
                        if ($(this).val() != 'Nuevo') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#estado').val('Nuevo');
                    $('#tipo_requerimiento option').each(function() {
                        if ($(this).val() != 'Capex') {
                            $(this).hide()
                        } else {
                            $(this).show()
                        }
                    })
                    $('#tipo_requerimiento').val('Orden de Compra');
                    $('#numero_requerimiento_group').show();
                    $('#numero_requerimiento').val('');
                } else {
                    $('#estado option').each(function() {
                        $(this).show()
                    })
                    $('#estado').val('');
                    $('#tipo_requerimiento option').each(function() {
                        $(this).show()
                    })
                    $('#tipo_requerimiento').val('');
                }
            })
            $("#agregarActivo").click((e) => {
                var datosArticulo = {
                    "atributos": {}
                };
                var validation = true;
                $('#modalEspecificaciones .modal-body .inpArticulo').each(function() {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    if (!value) {
                        alert(`El campo ${name} está vacío`)
                        e.preventDefault();
                        validation = false;
                        return false;
                    }
                    if (['articulo', 'articulo_nombre', 'costo_unitario', 'cantidad', 'descripcion']
                        .includes(name)) {
                        datosArticulo[name] = value
                    } else {
                        datosArticulo['atributos'][name] = value
                    }
                })
                if (validation) {
                    var rows = table.rows.length
                    var row = table.insertRow(rows);
                    var articulo = row.insertCell(0);
                    var articulo_nombre = row.insertCell(1);
                    var atributos = row.insertCell(2);
                    var cantidad = row.insertCell(3);
                    var costo_unitario = row.insertCell(4);
                    var descripcion = row.insertCell(5);
                    var colbtn = row.insertCell(6);
                    articulo.innerHTML =
                        `${datosArticulo['articulo']} <input type="hidden" name="activos[${rows}][id_articulo]" value="${datosArticulo['articulo']}" />`;
                    articulo_nombre.innerHTML =
                        `${datosArticulo['articulo_nombre']} <input type="hidden" name="activos[${rows}][articulo]" value="${datosArticulo['articulo_nombre']}" />`;
                    atributos.setAttribute('data-json', JSON.stringify(datosArticulo['atributos']));
                    atributos.innerHTML = Object.keys(datosArticulo['atributos']).map(a => {
                            return `${a}: ${datosArticulo['atributos'][a]}`
                        }).join('<br>') +
                        `<input type="hidden" name="activos[${rows}][atributos]" value='${JSON.stringify(datosArticulo['atributos'])}' />`;
                    cantidad.innerHTML =
                        `${datosArticulo['cantidad']} <input type="hidden" name="activos[${rows}][cantidad]" value="${datosArticulo['cantidad']}" />`;
                    costo_unitario.innerHTML =
                        `${datosArticulo['costo_unitario']} <input type="hidden" name="activos[${rows}][costo_unitario]" value="${datosArticulo['costo_unitario']}" />`;
                    descripcion.innerHTML =
                        `${datosArticulo['descripcion']} <input type="hidden" name="activos[${rows}][descripcion]" value="${datosArticulo['descripcion']}" />`;
                    colbtn.innerHTML = '<input type="button"  class="btn btn-primary" value="Quitar de la lista" onclick="deleteRow(this)"/>';
                    $('#articulo').val('').change();
                    $('#modalEspecificaciones').modal('hide');
                }
            })
            $('#frmAdquisicion').submit(e => {
                e.preventDefault()
                var activos = obtenerActivos();
                if (!activos.length) {
                    alert('Falta agregar activos')
                } else {
                    e.currentTarget.submit();
                }
            })
        })
    </script>
    <script>
    </script>
@endpush
