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
    .card-data{

    }
    .card-data label{
        text-align: center;
        margin-top: 3em;
    }
</style>
@stop
@section('content_header')
<h1 class="d-inline"> Enercare BO Tracker Resume</h1>
<div class="float-right">
    <a href="/enercare/botracker" class="btn btn-info" type="button" title="return" ><i class="fas fa-undo"></i></a>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Queue Tracker</label>
                    <span>{{$trkEdit->queue_tracker}}</span>
                    <br>
                    <label for="">Case</label>
                    <span>{{$trkEdit->case}}</span>
                    <br>
                    <label for="">Case Actioned</label>
                    <span>{{$trkEdit->case_actioned}}</span>
                    <br>
                    <label for="">Created</label>
                    <span>{{$trkEdit->created}}</span>
                    <br>
                    <label for="">Created By</label>
                    <span>{{$trkEdit->creador->name}}</span>
                    <br>
                    <label for="">Modified</label>
                    <span>{{$trkEdit->modified}}</span>
                    <br>
                    <label for="">Call Centre</label>
                    <span>{{$trkEdit->call_centre}}</span>
                    <br>
                    <label for="">Time Elapsed Since Creation</label>
                    <span>{{$elapsed }}</span>
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
@stop
