@extends('adminlte::page')
@section('title_postfix', ' | Enercare BO Tracker Edit')
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
    .card-data{

    }
    .card-data label{
        text-align: center;
        margin-top: 3em;

    }
</style>
@stop
@section('content_header')
<h1 class="d-inline"> Enercare BO Tracker Edit</h1>
<div class="float-right">
    <a href="/enercare/botracker" class="btn btn-info" type="button" title="return" ><i class="fas fa-undo"></i></a>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {!! Form::model($trkEdit, ['route' => ['botracker.update', $trkEdit->id], 'method' => 'PATCH']) !!}
                <div class="form-group">
                    <div class="form-group col-md-8">
                        <label for="Queue_Tracker">Queue Tracker</label>
                            <input type="text"
                            class="form-control"
                            id="queue_tracker"
                            placeholder="Queue Tracker"
                            name="queue_tracker"
                            value="{{ old('queue_tracker' , $trkEdit->queue_tracker)}}">
                        </div>
                        <div class="form-group col-md-8">
                        <label for="Case">Case</label>
                            <input type="text"
                            class="form-control"
                            id="Case"
                            placeholder="Case"
                            name="Case"
                            value="{{ old('case' , $trkEdit->case)}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
