@extends('adminlte::page')
@section('title_postfix', ' | Moduurn Tracker')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/moduurn.css') }}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="\img\moduurn\ModuurnLogo2.svg" />
    <a href="/moduurn/calltracker" class="btn btn-info float-right" type="button" title="return"><i class="fas fa-undo"></i></a>
    <h1 class="title_h1"> Moduurn Tracker</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card_first">
                <div class="card-body">
                    <div class="card col-md-12">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Principal Phone</label>
                                <span class="span_item float-right">{{ $trkEdit->phone_number1 }}</span><br>
                                <label for="">Secundary Phone</label>
                                <span class="span_item float-right">{{ $trkEdit->phone_number2 }}</span><br>
                                <label for="">List Id</label>
                                <span class="span_item float-right">{{ $trkEdit->list_id }}</span><br>
                                <label for="">Not Show</label>
                                <span class="span_item float-right">{{ $trkEdit->not_show }}</span><br>
                                <label for="">Is Schedule</label>
                                <span class="span_item float-right">{{ $trkEdit->is_schedule }}</span><br>
                                <label for="">Reason Not Schedule</label>
                                <span class="span_item float-right">{{ $trkEdit->reason_not_schedule }}</span><br>
                                <label for="">Type</label>
                                <span class="span_item float-right">{{ $trkEdit->type }}</span><br>
                                <label for="">Transfer Call</label>
                                <span class="span_item float-right">{{ $trkEdit->transferCall }}</span><br>
                                <label for="">Date Schedule</label>
                                <span class="span_item float-right">{{ $trkEdit->date_schedule }}</span><br>
                                <label for="">Ubication</label>
                                <span class="span_item float-right">{{ $trkEdit->country }} {{ $trkEdit->region }} {{ $trkEdit->state }}</span><br>
                                <label for="">Expert</label>
                                <span class="span_item float-right">{{ $trkEdit->expert }}</span><br>
                                <label for="">Created</label>
                                <span class="span_item float-right">{{ $trkEdit->created }}</span><br>
                                <label for="">Created By</label>
                                <span class="span_item float-right">{{ $trkEdit->creador->name}}</span><br>
                                @if ($trkEdit->created != $trkEdit->modified)
                                    <span class="badge badge-info"><strong> Case Modified At Least Once</strong></span>
                                @else
                                    <span class="badge badge-secondary">Case Unchanged Since Its Creation</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
