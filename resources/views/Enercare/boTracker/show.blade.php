@extends('adminlte::page')
@section('title_postfix', ' | Enercare BO Tracker')
@section('css')
<link rel="stylesheet" href="{{asset('css/enercare.css')}}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="\img\EnercareTracker\enercare-seeklogo.com.svg" />
<a href="/enercare/botracker" class="btn btn-info float-right" type="button" title="return" ><i class="fas fa-undo"></i></a>
<h1 class="title_h1"> Enercare BO Tracker</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card_first">
            <div class="card-body">
                <div class="card col-md-12">
                    <div class="card-body">
                <div class="form-group">
                    <label for="">Queue Tracker</label>
                    <span class="span_item float-right">{{$trkEdit->queue_tracker}}</span>
                    <br>
                    <label for="">Case</label>
                    <span class="span_item float-right">{{$trkEdit->case}}</span>
                    <br>
                    <label for="">Case Actioned</label>
                    <span class="span_item float-right">{{$trkEdit->case_actioned}}</span>
                    <br>
                    <label for="">Created</label>
                    <span class="span_item float-right">{{$trkEdit->created}}</span>
                    <br>
                    <label for="">Created By</label>
                    <span class="span_item float-right">{{$trkEdit->creador->name}}</span>
                    <br>
                    <label for="">Modified</label>
                    <span class="span_item float-right">{{$trkEdit->modified}}</span>
                    <br>
                    <label for="">Call Centre</label>
                    <span class="span_item float-right">{{$trkEdit->call_centre}}</span>
                    <br>
                    <label for="">Time Elapsed Since Creation</label>
                    <span class="span_item float-right">{{$elapsed }}</span>
                    <br>
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
