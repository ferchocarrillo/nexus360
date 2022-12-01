@extends('adminlte::page')
@section('title_postfix', ' | Enercare BO Tracker')
@section('css')
<style>
    .card-tracker {
        margin-inline: 1rem;
        transition: all 0.2s ease-in-out;
        transform-origin: top left;
        width: 170px !important;
        height: 70px !important;
        overflow: hidden;
        -webkit-box-shadow: 7px 7px 15px 2px #aaa1a1;
        box-shadow: 7px 7px 15px 2px #aaa1a1;
        padding: 10px;
        border: none;
        font-family: 'Roboto Flex', sans-serif;
    }
    .card-tracker:hover {
        transform: scale(1.2);
        z-index: 999;
        height: 110px !important;
    }
    label{
        color: black;
    }
    .title{
        color: black;
        text-align: center;
    }
</style>
@stop
@section('content_header')
<h1 class="d-inline"> Enercare BO Tracker</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card"
            style="color:aliceblue; background: linear-gradient(rgba(250,197,202,255),rgba(251,211,215,255));">
            <div class="card-body">
                <h3 class="title">Create New Tracker</h3>
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
                    <div class="form-group col-sm-12" >
                        <label for="queue">Queue Tracker</label>
                            <select id="options-oba" name="queue_tracker" class="custom-select"  style="display: none">
                                <option value="" disabled selected>--Select a option--</option>
                                @foreach ($obas as $oba)
                                <option value="{{$oba}}">{{$oba}}</option>
                                @endforeach
                            </select>
                            <select id="options-offline" name="queue_tracker" class="custom-select" style="display: none">
                                <option value="" disabled selected>--Select a option--</option>
                                @foreach ($offlines as $offline)
                                <option value="{{$offline}}">{{$offline}}</option>
                                @endforeach
                            </select>
                            <label for="queue" style="display: none" id="labelQueueOba">Case Number</label>
                            <label for="queue" style="display: none" id="labelQueueOffline">DEBE Account/ Site ID/ Case Number</label>
                            <input type="number" id="case" name="case" class="form-control" value="">
                            <input type="hidden" id="case_actioned" name="case_actioned" value="">                            <br>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbspSave</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-8">
        <table class="table table-hover" id="tracker_table">
            <thead>
                <tr>
                    <td scope="col"><strong> Queue Tracker</strong></td>
                    <td scope="col"><strong> Case</strong></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($trackers_lists as $track)
                    <tr>
                        <td>{{$track->queue_tracker}}</td>
                        <td>{{$track->case}}</td>
                    <td>
                        <a  href="{{ url('/enercare/botracker/'. $track->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="See Case">
                            <i class="fas fa-eye"></i>
                        </a>
                        @can('enercare.botracker.leader')
                        <a  href="{{ url('/enercare/botracker/'. $track->id.'/edit' )}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="Edit Case">
                            <i class="fas fa-eye-dropper"></i>
                        </a>
                        @endcan
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('js')
        <script type="text/javascript" src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
        <script type="text/javascript" src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }} "></script>
        <script>
        function miFunc() {
        var today = new Date();
        var now = new Date().toLocaleString("sv-SE",{hour12:false});
        event.preventDefault();
        $('#options').show();
        $('#options-oba').show();
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
@stop
