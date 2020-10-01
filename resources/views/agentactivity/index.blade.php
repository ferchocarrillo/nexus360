@extends('adminlte::page')

{{-- @section('title', 'Dashboard' . ' | ' .  config('app.name', 'Laravel')) --}}
@section('title_postfix', ' | Agent Activity')


@section('css')
{{-- <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css') }} "> --}}
@stop

@section('content_header')
<h1 class="d-inline">Agent Activity</h1>
@stop

@section('content')


<agentactivity-component v-bind:timeserver="{{"'".date('Y-m-d H:i:s')."'"}}" v-bind:activities="{{$activities}}" v-bind:useractivity="{{$userActivity ? $userActivity : 'null' }}" ></agentactivity-component>


<iframe style="display: none;" src="{{'http://'. request()->getHost().':3000'}}" frameborder="0" id="ifm_activity"></iframe>
@stop
