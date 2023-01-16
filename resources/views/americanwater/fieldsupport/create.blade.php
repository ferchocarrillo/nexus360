@extends('adminlte::page')
@section('title_postfix', ' | Create Fields Support Items')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/fieldsupport.css')}}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="{{asset('/img/americanWater/american_water_logo.png')}}" />
@if (Auth::user()->can('americanwater.fieldsupport'))
<div class="float-right">
    <a href="/americanwater/fieldsupport" class="btn btn-info" type="button" title="return"><i
            class="fas fa-undo"></i></a>
</div>
@endif
<h1 class="title_h1">Field Support List</h1>
@stop
@section('content')

<div class="container-fluid px-12 ">
    <div class="card-column">
        <div class="card border-info" id="card_top">
        <div id="contenedor">
            <input type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
            <div></div>
            <div class="reloj" id="Horas">00</div>
            <div class="reloj" id="Minutos">:00</div>
            <div class="reloj" id="Segundos">:00</div>
            <div class="reloj" id="Centesimas">:00</div>
        </div>
    </div>
    <div class="card border-info ">
        <div class="row principal_card" id="div_options" style="display: none" >
            <div class="col-md-12">
                <div class="card_first">
                    <div class="card-body" >
                        {!! Form::open(['route' => 'fieldsupport.store', 'method' => 'POST']) !!}
                        <div class="card col-md-12" id="options" >
                            <div class="card-body">
                                <div class="form-group col-sm-12" >
                                    <label class="label_text" for="claim">Claim Number <span class="span_label">*</span> </label>
                                    {{ Form::text('claim', null, ['placeholder' => 'Claim', 'class' => 'form-control ' . ($errors->has('claim') ? 'is-invalid' : ''), 'minlength' => '7', 'maxlength' => '7 ', 'required']) }}
                                    <br>
                                    <label class="label_text" for="threshold">Threshold <span class="span_label">*</span></label>
                                    <select id="threshold" name="threshold" class="custom-select" required>
                                        <option value="" disabled selected>--Select a option--</option>
                                        @foreach ($thereshold as $th)
                                        <option value="{{$th}}">{{$th}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label class="label_text" for="status">Status <span class="span_label">*</span></label>
                                    <select id="status" name="status" class="custom-select"  required>
                                        <option value="" disabled selected>--Select a option--</option>
                                        @foreach ($invoice as $inv)
                                        <option value="{{$inv}}">{{$inv}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label class="label_text" for="observations">Observations</label>
                                    <textarea class="form-control" name="observations" id="observations" cols="30" rows="3"></textarea>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbspSave</button>
                                    <input type="hidden" id="case_actioned" name="case_actioned" value="{{date('Y-m-d H:i:s')}}">
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
















<div class="card-column">
{{--  <div id="contenedor">


    <input type="button" class="boton" id="inicio" value="Start &#9658;" onclick="inicio();">
    <div></div>
    <div class="reloj" id="Horas">00</div>
    <div class="reloj" id="Minutos">:00</div>
    <div class="reloj" id="Segundos">:00</div>
    <div class="reloj" id="Centesimas">:00</div>

    {{--  <input type="button" class="boton" id="parar" value="Stop &#8718;" onclick="parar();" disabled>
    <input type="button" class="boton" id="continuar" value="Resume &#8634;" onclick="inicio();" disabled>
    <input type="button" class="boton" id="reinicio" value="Reset &#8635;" onclick="reinicio();" disabled>
</div>  --}}


<div class="row principal_card" id="div_options" style="display: none" >
    <div class="col-md-12">
        <div class="card_first">
            <div class="card-body" >
                {!! Form::open(['route' => 'fieldsupport.store', 'method' => 'POST']) !!}
                <div class="card col-md-12" id="options" >
                    <div class="card-body">
                        <div class="form-group col-sm-12" >
                            <label class="label_text" for="claim">Claim Number <span class="span_label">*</span> </label>
                            {{ Form::text('claim', null, ['placeholder' => 'Claim', 'class' => 'form-control ' . ($errors->has('claim') ? 'is-invalid' : ''), 'minlength' => '7', 'maxlength' => '7 ', 'required']) }}
                            <br>
                            <label class="label_text" for="threshold">Threshold <span class="span_label">*</span></label>
                            <select id="threshold" name="threshold" class="custom-select" required>
                                <option value="" disabled selected>--Select a option--</option>
                                @foreach ($thereshold as $th)
                                <option value="{{$th}}">{{$th}}</option>
                                @endforeach
                            </select>
                            <br>
                            <label class="label_text" for="status">Status <span class="span_label">*</span></label>
                            <select id="status" name="status" class="custom-select"  required>
                                <option value="" disabled selected>--Select a option--</option>
                                @foreach ($invoice as $inv)
                                <option value="{{$inv}}">{{$inv}}</option>
                                @endforeach
                            </select>
                            <br>
                            <label class="label_text" for="observations">Observations</label>
                            <textarea class="form-control" name="observations" id="observations" cols="30" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbspSave</button>
                            <input type="hidden" id="case_actioned" name="case_actioned" value="{{date('Y-m-d H:i:s')}}">
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
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
        function inicio () {
            axios.get('/getdatenow').then(res => {
            var now = res.data;
            control = setInterval(cronometro,10);
            document.getElementById("inicio").disabled = true;
            $('#div_options').show();
            $('#case_actioned').val(now);
        })
        }
        function cronometro () {
            if (centesimas < 99) {
                centesimas++;
                if (centesimas < 10) { centesimas = "0"+centesimas }
                Centesimas.innerHTML = ":"+centesimas;
            }
            if (centesimas == 99) {
                centesimas = -1;
            }
            if (centesimas == 0) {
                segundos ++;
                if (segundos < 10) { segundos = "0"+segundos }
                Segundos.innerHTML = ":"+segundos;
            }
            if (segundos == 59) {
                segundos = -1;
            }
            if ( (centesimas == 0)&&(segundos == 0) ) {
                minutos++;
                if (minutos < 10) { minutos = "0"+minutos }
                Minutos.innerHTML = ":"+minutos;
            }
            if (minutos == 59) {
                minutos = -1;
            }
            if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
                horas ++;
                if (horas < 10) { horas = "0"+horas }
                Horas.innerHTML = horas;
            }
        }
    </script>
@endpush
