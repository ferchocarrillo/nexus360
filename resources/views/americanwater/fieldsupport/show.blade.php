@extends('adminlte::page')
@section('title_postfix', ' | Field Support Resume')
@section('css')
<link rel="stylesheet" href="{{asset('css/fieldsupport.css')}}">
@stop
@section('content_header')
<img alt="logo" class="logo" src="{{asset('/img/americanWater/american_water_logo.png')}}" />
<h1 class="title_h1"> Field Support Resume</h1>
<div class="float-right">
    <a href="/americanwater/fieldsupport" class="btn btn-info" type="button" title="return"><i
            class="fas fa-undo"></i></a>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-sm-6 card_first">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Claim Number</label>
                    <span class="span_item">{{$field->claim_number}}</span>
                </div>
        <div class="form-group">
            <label for="">Threshold</label>
            <span class="span_item">{{$field->threshold}}</span>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <span class="span_item">{{$field->status}}</span>
        </div>
        <div class="form-group">
            <label for="">Observations</label>
            <span class="span_item">{{$field->observations}}</span>
        </div>
        <div class="form-group">
            <label for="">Case Actioned</label>
            <span class="span_item">{{$field->case_actioned}}</span>
        </div>
    </div>
</div>
</div>
    <div class="col-sm-6 card_first">
        <div class="card">
            <div class="card-body">
                    <div class="form-group">
                        <label for="">Created</label>
                        <span class="span_item">{{$field->created}}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Modified</label>
                        <span class="span_item">{{$field->modified}}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Created By</label>
                        <span class="span_item">{{$field->creador->name}}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Time Elapsed Since Creation</label>
                        <span class="span_item">{{$elapsed }}</span>
                    </div>
                    <div class="form-group">
                        @if ($field->created != $field->modified)
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
