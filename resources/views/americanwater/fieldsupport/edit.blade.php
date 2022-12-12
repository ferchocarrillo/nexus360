@extends('adminlte::page')
@section('title_postfix', ' | Field Support Edit')
@section('css')
<link rel="stylesheet" href="{{asset('css/fieldsupport.css')}}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="{{asset('/img/americanWater/american_water_logo.png')}}" />
<h1 class="title_h1"> Field Support Edit</h1>
<div class="float-right">
    <a href="/americanwater/fieldsupport" class="btn btn-info" type="button" title="return" ><i class="fas fa-undo"></i></a>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card_first">
            <div class="card-body">
                {!! Form::model($field, ['route' => ['fieldsupport.update', $field->id], 'method' => 'PATCH']) !!}
                <div class="card col-md-12" id="options" >
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="Queue_Tracker">Claim Number</label>
                            <input type="text"
                            class="form-control"
                            id="claim_number"
                            placeholder="Claim Number"
                            name="claim_number"
                            value="{{ old('claim_number' , $field->claim_number)}}">
                        </div>
                        <div class="form-group col-md-12">
                        <label for="threshold">Threshold</label>
                        {{ Form::select('threshold', $threshold, null, [ 'class' => 'custom-select ' . ($errors->has('threshold') ? 'is-invalid' : ''), 'required']) }}
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">Status</label>
                            {{ Form::select('status', $invoice, null, ['class' => 'custom-select ' . ($errors->has('status') ? 'is-invalid' : ''), 'required']) }}
                            </div>
                            <div class="form-group col-md-12">
                                <label for="observations">Observations</label>
                                    <input type="text"
                                    class="form-control"
                                    id="observations"
                                    placeholder="Observations"
                                    name="observations"
                                    value="{{ old('observations' , $field->observations)}}">
                                </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    {!! Form::close() !!}
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
