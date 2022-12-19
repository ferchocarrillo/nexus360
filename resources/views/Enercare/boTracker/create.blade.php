@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/enercare.css') }}">
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
                                <div class="row card-bot">
                                    <div class="form-group">
                                        <button class="card-tracker" id="lob_oba" onclick="oba()">
                                            <img class="logo-img" alt="logo"
                                                src="\img\EnercareTracker\enercare_oba.png" /></button>
                                        <div class="details">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="card-tracker" id="lob_offline" onclick="offline()">
                                            <img class="logo-img" alt="logo"
                                                src="\img\EnercareTracker\enercare_offline.png" /></button>
                                        <div class="details">
                                        </div>
                                    </div>
                                    <div class="card-rest" style="display: none" id="rest" onclick="restaurar()">
                                        Restablecer
                                    </div>
                                </div>
                                {!! Form::open(['route' => 'botracker.store', 'method' => 'POST']) !!}
                                <input type="hidden" id="lob" name="lob" value="">
                                <div class="card col-md-12" id="options" style="display: none">
                                    <div class="card-body">
                                        <div class="form-group col-sm-12">
                                            <label for="queue">Queue Tracker <span class="span_label">*</span></label>
                                            <select id="options-oba" name="queue_tracker" class="custom-select"
                                                style="display: none" onclick="obaFunc()">
                                                <option value="" disabled selected>--Select a option--</option>
                                                @foreach ($obas as $oba)
                                                    <option value="{{ $oba }}">{{ $oba }}</option>
                                                @endforeach
                                            </select>
                                            <select id="options-offline" name="queue_tracker" class="custom-select"
                                                style="display: none" onclick="offFunc()">
                                                <option value="" disabled selected>--Select a option--</option>
                                                @foreach ($offlines as $offline)
                                                    <option value="{{ $offline }}">{{ $offline }}</option>
                                                @endforeach
                                            </select>
                                            <label for="queue" style="display: none" id="labelQueueOba">Case Number <span
                                                    class="span_label">*</span></label>
                                            <label for="queue" style="display: none" id="labelQueueOffline">DEBE Account/
                                                Site ID/ Case Number <span class="span_label">*</span></label>
                                            <input type="number" style="display: none" id="case" name="case"
                                                class="form-control" value="" required>
                                            <input type="hidden" id="case_actioned" name="case_actioned" value="">
                                            <br>
                                            <input id="serverDate" type="hidden" value="<?php echo date('Y-m-d'); ?>">
                                            <button style="display: none" id="boton" type="submit"
                                                class="btn btn-primary"><i class="fas fa-save"></i>&nbspSave</button>
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
        const getTimeServer = async () => {
            const res = await axios.get('/getdatenow')
            return res.data;
        }
        function oba() {
            $('#lob_oba').prop('disabled', true);
            axios.get('/getdatenow').then(res => {
                var now = res.data;
                $('#lob').val('OBA');
                $('#options').show();
                $('#options-oba').show();
                $('#options-offline').hide();
                $('#case_actioned').val(now);
                $('#lob_oba').show();
                $('#lob_offline').hide();
                $('#rest').show();
            })
        }

        function offline() {
            $('#lob_offline').prop('disabled', true);
            axios.get('/getdatenow').then(res => {
                var now = res.data;
                $('#lob').val('OFFLINE');
                $('#options').show();
                $('#options-oba').hide();
                $('#options-offline').show();
                $('#case_actioned').val(now);
                $('#lob_offline').show();
                $('#lob_oba').hide();
                $('#rest').show();
            })
        }

        function restaurar() {

                $('#lob').val('');
                $('#rest').hide();
                $('#case_actioned').val('');
                $('#options').hide();
                $('#labelQueueOba').hide();
                $('#labelQueueOffline').hide();
                $('#case').hide();
                $('#options-oba option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#options-offline option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#case').val('');
                $('#lob_oba').prop('disabled', false);
                $('#lob_offline').prop('disabled', false);
                $('#lob_oba').show();
                $('#lob_offline').show();
        }

        function obaFunc() {
                $('#labelQueueOba').show();
                $('#case').show();
                $('#labelQueueOba').show();
                $('#labelQueueOffline').hide();
                $('#boton').show();
        }

        function offFunc() {
                $('#labelQueueOba').hide();
                $('#case').show();
                $('#labelQueueOba').show();
                $('#labelQueueOffline').show();
                $('#boton').show();
        }
    </script>
@endpush
