@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{asset('css/enercare.css')}}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
@if (Auth::user()->can('enercare.botracker'))
<div class="float-right">
    <a href="/enercare/botracker" class="btn btn-info" type="button" title="return"><i class="fas fa-undo"></i></a>
</div>
@endif
<h1 class="title_h1">Enercare Bo Tracker Create</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card_first">
            <div class="card-body">
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="form-group col-sm-12">
                            <div class="row">
                            <div class="form-group">
                                <div class="card card-tracker" onclick="miFunc()">
                                    <img alt="logo" src="\img\EnercareTracker\enercare_oba.png" />
                                    <div class="details">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card card-tracker" onclick="miFunc2()">
                                    <img alt="logo" src="\img\EnercareTracker\enercare_offline.png" />
                                    <div class="details">
                                    </div>
                                </div>
                            </div>
                        </div>
                            {!! Form::open(['route' => 'botracker.store', 'method' => 'POST']) !!}
                            <div class="card col-md-12" id="options" style="display: none">
                                <div class="card-body">
                                    <div class="form-group col-sm-12">
                                        <label for="queue">Queue Tracker <span class="span_label">*</span></label>
                                        <select id="options-oba" name="queue_tracker" class="custom-select" style="display: none" >
                                            <option value="" disabled selected>--Select a option--</option>
                                            @foreach ($obas as $oba)
                                            <option value="{{$oba}}">{{$oba}}</option>
                                            @endforeach
                                        </select>
                                        <select id="options-offline" name="queue_tracker" class="custom-select" style="display: none" >
                                            <option value="" disabled selected>--Select a option--</option>
                                            @foreach ($offlines as $offline)
                                            <option value="{{$offline}}">{{$offline}}</option>
                                            @endforeach
                                        </select>
                                        <label for="queue" style="display: none" id="labelQueueOba">Case Number <span class="span_label">*</span></label>
                                        <label for="queue" style="display: none" id="labelQueueOffline">DEBE Account/ Site ID/ Case Number <span class="span_label">*</span></label>
                                        <input type="number" id="case" name="case" class="form-control" value="" required>
                                        <input type="hidden" id="case_actioned" name="case_actioned" value="">
                                        <br>
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-save"></i>&nbspSave</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            @stop

            @push('js')
            <script>
                function miFunc() {
        var today = new Date();
        var now = new Date().toLocaleString("sv-SE",{hour12:false});
        event.preventDefault();
        $('#options').show();
        $('#options-oba').show();
        $('#options-oba').required = true;
        $('#options-offline').hide();
        $('#labelQueueOba').show();
        $('#labelQueueOffline').hide();
        $('#case_actioned').val(now);
        }
        function miFunc2() {
        var today = new Date();
        var now = new Date().toLocaleString("sv-SE",{hour12:false});
        event.preventDefault();
        $('#options').show();
        $('#options-offline').show();
        $('#options-offline').required = true;
        $('#options-oba').hide();
        $('#labelQueueOffline').show();
        $('#labelQueueOba').hide();
        $('#case_actioned').val(now);
        }
            $(document).ready(function() {
                $('#tracker_table').DataTable({
                    language: {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        search: `<div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>`,
                        searchPlaceholder: 'Buscar...',
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                    }
                });
            })
            </script>
            @endpush

