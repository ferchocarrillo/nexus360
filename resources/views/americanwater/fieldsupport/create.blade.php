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
<div class="row">
    <div class="col-md-12">
        <div class="card_first">
            <div class="card-body" >
                {!! Form::open(['route' => 'fieldsupport.store', 'method' => 'POST']) !!}
                <div class="card col-md-12" id="options" >
                    <div class="card-body">
                        <div class="form-group col-sm-12" >
                            <label class="label_text" for="claim">Claim Number <span class="span_label">*</span> </label>
                                <input type="number" id="claim" name="claim" class="form-control" required >
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
@stop
