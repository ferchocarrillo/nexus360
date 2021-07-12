@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Home')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <a href="/pandorasbox">
                <img src="/img/pandorasbox/banner.png" alt="Pandora's Box" width="100%">
                </a>
            </div>
        </div>
    </div>    
</div>

@stop
