@extends('adminlte::page')
@section('title_postfix', ' | Asignaciones')
@section('content_header')
    <h1>Activos Disponibles</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="national_id">Numero de Documento</label>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" name="national_id" id="national_id"
                            placeholder="Escriba el numero de documento" list="listEmployees" />
                        <div class="input-group-append">
                            <button class="btn btn-secondary" id="searchEmployee" type="button"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <datalist id="listEmployees">
                        @foreach ($employess as $employee)
                            <option value="{{ $employee->national_id }}">{{ $employee->full_name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
    </div>
    <div id="employeeInfo"></div>
    <div id="employeeAssignations"></div>
    <!-- Modal -->
    <div class="modal fade" id="modalEspecificaciones" tabindex="-1" role="dialog"
        aria-labelledby="modalEspecificacionesTitulo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('inventories/asignacion') }}" id="frmAsignacion" method="POST"
                    enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEspecificacionesTitulo">Activos a Asignar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        {{ Form::label('motivo', 'Motivo de Asignación') }}
                                        {{ Form::select('motivo', $motivos, null, ['placeholder' => '--', 'class' => 'inpArticulo custom-select ' . ($errors->has('motivo') ? 'is-invalid' : ''), 'required']) }}
                                    </div>
                                    <div class="col-12">
                                        <label for="articulo">Articulos</label>
                                        <div class="input-group mb-12">
                                            <input type="search" class="form-control" name="articulo" id="articulo"
                                                placeholder="Seleccione el articulo a asignar" list="listArticulo"
                                                autocomplete="off" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" id="searchArticulo" type="button"><i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <datalist id="listArticulo">
                                            @foreach ($articulos as $articulo)
                                                <option value="{{ $articulo->codigo }}">{{ $articulo->articulo }}
                                                </option>
                                            @endforeach
                                        </datalist>
                                        <div class="col-12">
                                            <label for="">Observación</label>
                                            <textarea class="form-control" name="observacion" id="observacion"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="national_id" id="modal_national_id" required>
                        <div id="findArticulo"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                        <button type="submit" id="agregarActivo" class="btn btn-primary">Agregar Activo</button>
                    </div>
                    //
                </form>
                </form>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(document).ready(function() {
            function getEmployeeAssignations() {
                let national_id = $('#national_id').val();
                axios.post('/inventories/asignacion/employeeAssignations', {
                        national_id
                    })
                    .then(function(res) {
                        $('#modal_national_id').val(national_id);
                        $('#employeeAssignations').html(res.data)
                    })
            }
            $('#searchEmployee').click((e) => {
                let national_id = $('#national_id').val();
                axios.post('/inventories/asignacion/findemployee', {
                        national_id
                    })
                    .then(function(res) {
                        $('#employeeInfo').html(res.data)
                        getEmployeeAssignations()
                    })
            })
        })
        $('#articulo').on('change', function(e) {
            $('#datosArtAsignado').html('');
            $('#cantidad').val('');
            $('#costo_unitario').val('');
            $('#descripcion').val('');
            $('#findArticulo').html('');
            var articulo = $('#articulo').val();
            if (articulo) {
                axios.post("{{ route('inventories.asignacion.findArticulo') }}", {
                        articulo
                    })
                    .then(function(res) {
                        $('#findArticulo').html(res.data);
                    })
            }
        });
    </script>
@endpush
