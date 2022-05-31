@extends('adminlte::page')
@section('title_postfix', ' | Scorecard')
@section('content_header')
    <link rel="stylesheet" href="/css/reports.css">
    <h6><img src="/img/reportinglinks/scorecard.png" alt="" style="width: 15%"></h6>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($campañas as $key => $links)
                <div class="card card-campaign">
                    <img alt="logo" src="{{asset('storage/'.$links[0]->logo)}}" />
                    <div class="details">
                        @foreach ($links as $link)
                            <a href="{{ $link->url }}" target="iframe_a">{{ $link->name }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="page">
        <iframe src="" name="iframe_a" class="frame" frameborder="0"></iframe>
    </div>
    </div>
@stop
