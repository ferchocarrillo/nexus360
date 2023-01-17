@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fieldsupport.css') }}">
@stop
@section('content_header')
    <img alt="logo" class="logo" src="{{ asset('/img/americanWater/american_water_logo.png') }}" />
    @if (Auth::user()->can('americanwater.fieldsupport'))
        <div class="float-right">
            <a href="/americanwater/fieldsupport" class="btn btn-info" type="button" title="return"><i
                    class="fas fa-undo"></i></a>
        </div>
    @endif
    <h1 class="title_h1">Field Support List</h1>
@stop
@section('content')
    <div class="card-group card">
        <div class="card_star">
            <div class="col-md-4">
                <input type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
                <div></div>
                <div class="reloj" id="Horas">00</div>
                <div class="reloj" id="Minutos">:00</div>
                <div class="reloj" id="Segundos">:00</div>
                <div class="reloj" id="Centesimas">:00</div>
            </div>
        </div>
        <div class="card" id="div_options" style="display: none">
            <div class="card_button">
                <button class="card-tracker" id="but_pro" onclick="processing()">
                    Processing</button>
                <button class="card-tracker" id="but_index" onclick="indexing()">
                    Indexing
                </button>
                <button class="card-rest" style="display:none" id="rest" onclick="restaurar()">Reset &#8635;</button>
            </div>
        </div>
    </div>
    <div class="container-fluid px-12 ">
        <div class="card-column">
            <div class="card border-info ">
                <div class="row principal_card" id="div_form" style="display: none">
                    <div class="col-md-12">
                        <div class="card_first">
                            <div class="card-body">
                                {!! Form::open(['route' => 'fieldsupport.store', 'method' => 'POST']) !!}
                                <input type="hidden" id="cph" name="cph">
                                <div class="card col-md-12" id="options">
                                    <div class="card-body">
                                        <div class="form-group col-sm-12">
                                            <label class="label_text" for="claim">Claim Number <span
                                                    class="span_label">*</span> </label>
                                            {{ Form::text('claim', null, ['placeholder' => 'Claim', 'class' => 'form-control ' . ($errors->has('claim') ? 'is-invalid' : ''), 'minlength' => '7', 'maxlength' => '7 ', 'required']) }}
                                            <br>
                                            <div id="div_thereshold" style="display: none">
                                                <label class="label_text" for="threshold">Threshold <span
                                                        class="span_label">*</span></label>
                                                <select id="threshold" name="threshold" class="custom-select">
                                                    <option value="" disabled selected>--Select a option--
                                                    </option>
                                                    @foreach ($thereshold as $th)
                                                        <option value="{{ $th }}">{{ $th }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                            <div id="div_status" style="display: none">
                                                <label class="label_text" for="status">Status <span
                                                        class="span_label">*</span></label>
                                                <select id="status" name="status" class="custom-select">
                                                    <option value="" disabled selected>--Select a option--
                                                    </option>
                                                    @foreach ($invoice as $inv)
                                                        <option value="{{ $inv }}">{{ $inv }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                            <div id="div_type" style="display: none">
                                                <label class="label_text" for="type">Type <span
                                                        class="span_label">*</span></label>
                                                <select id="type" name="type" class="custom-select">
                                                    <option value="" disabled selected>--Select a option--
                                                    </option>
                                                    @foreach ($type as $tp)
                                                        <option value="{{ $tp }}">{{ $tp }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                            <label class="label_text" for="observations">Observations</label>
                                            <textarea class="form-control" placeholder="Observations" id="observations" name="observations" cols="30"
                                                rows="3" maxlength="150" minlength="10" required></textarea>
                                            <span class="badge bg-primary float-right" id="characterCount">0/150</span>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-save"></i>&nbspSave</button>
                                            <input type="hidden" id="case_actioned" name="case_actioned"
                                                value="{{ date('Y-m-d H:i:s') }}">
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
    </div>
@stop
@push('js')
    <script>
        const getTimeServer = async () => {
            const res = await axios.get('/getdatenow')
            return res.data;
        }
        var centesimas = 0;
        var segundos = 0;
        var minutos = 0;
        var horas = 0;
        function inicio() {
            $('#div_options').show();
            document.getElementById("inicio").disabled = true;
        }
        function cronometro() {
            if (centesimas < 99) {
                centesimas++;
                if (centesimas < 10) {
                    centesimas = "0" + centesimas
                }
                Centesimas.innerHTML = ":" + centesimas;
            }
            if (centesimas == 99) {
                centesimas = -1;
            }
            if (centesimas == 0) {
                segundos++;
                if (segundos < 10) {
                    segundos = "0" + segundos
                }
                Segundos.innerHTML = ":" + segundos;
            }
            if (segundos == 59) {
                segundos = -1;
            }
            if ((centesimas == 0) && (segundos == 0)) {
                minutos++;
                if (minutos < 10) {
                    minutos = "0" + minutos
                }
                Minutos.innerHTML = ":" + minutos;
            }
            if (minutos == 59) {
                minutos = -1;
            }
            if ((centesimas == 0) && (segundos == 0) && (minutos == 0)) {
                horas++;
                if (horas < 10) {
                    horas = "0" + horas
                }
                Horas.innerHTML = horas;
            }
        }
        function processing() {
            $('#but_pro').prop('disabled', true);
            $('#but_index').prop('disabled', false);
            $('#but_index').hide();
            $('#cph').val('Processing');
            axios.get('/getdatenow').then(res => {
                control = setInterval(cronometro, 10);
                var now = res.data;
                $('#case_actioned').val(now);
                $('#div_form').show();
                $('#claim').val("");
                $('#observations').val("");
                $('#div_thereshold').show();
                $('#div_status').show();
                $('#type option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#div_type').hide();
                $('#rest').show();
            })
        }
        function indexing() {
            $('#but_index').prop('disabled', true);
            $('#but_pro').prop('disabled', false);
            $('#but_pro').hide();
            $('#cph').val('Indexing');
            axios.get('/getdatenow').then(res => {
                control = setInterval(cronometro, 10);
                var now = res.data;
                $('#case_actioned').val(now);
                $('#div_form').show();
                $('#claim').val("");
                $('#observations').val("");
                $('#threshold option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#div_thereshold').hide();
                $('#status option').prop('selected', function() {
                    return this.defaultSelected;
                });
                $('#div_status').hide();
                $('#div_type').show();
                $('#rest').show();
            })
        }
        function restaurar() {
            clearInterval(control);
            centesimas = 0;
            segundos = 0;
            minutos = 0;
            horas = 0;
            Centesimas.innerHTML = ":00";
            Segundos.innerHTML = ":00";
            Minutos.innerHTML = ":00";
            Horas.innerHTML = "00";
            $('#div_options').hide();
            $('#but_pro').prop('disabled', false);
            $('#but_index').prop('disabled', false);
            $('#cph').val("");
            $('#rest').hide();
            $('#case_actioned').val("");
            $('#div_form').hide();
            $('#but_pro').show();
            $('#but_index').show();
            $('#threshold option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#type option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#status option').prop('selected', function() {
                return this.defaultSelected;
            });
            document.getElementById("inicio").disabled = false;
            document.getElementById("reinicio").disabled = true;
        }
        $('textarea').keyup(function() {
            $('#characterCount').text($(this).val().length + "/150")
        });
    </script>
@endpush
